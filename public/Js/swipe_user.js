document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("explore-form");
    const container = document.getElementById("card-container");

    if (!form || !container || recruiterId === null) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const localisation = formData.get("localisation")?.trim();
        const rawSkills = formData.get("skills")?.trim();

        const skillList = rawSkills
            ? rawSkills.split(",").map(s => s.trim().toLowerCase()).filter(Boolean)
            : [];

        try {
            const res = await fetch("/public/api/get_swipe_user_data.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ localisation, skills: skillList })
            });

            const profiles = await res.json();
            container.innerHTML = "";

            if (!profiles.length) {
                container.innerHTML = "<p>Aucun profil trouvé.</p>";
                return;
            }

            let currentIndex = 0;
            let isTouchDevice = false;

            function renderProfile(index) {
                if (index >= profiles.length) {
                    container.innerHTML = "<p>Plus de profils.</p>";
                    return;
                }

                const profile = profiles[index];
                const card = document.createElement("div");
                card.classList.add("card");
                card.style.zIndex = profiles.length - index;

                card.innerHTML = `
                    <img src="${profile.photo_path || '/public/images/default_missing_picture.png'}" alt="photo de profil">
                    <h2>${profile.Name}</h2>
                    <p>Email : ${profile.Email}</p>
                    <p>Description : ${profile.user_description || "Non renseignée"}</p>
                `;

                let startX = 0;
                let currentX = 0;
                let isDragging = false;

                const startDrag = (x) => {
                    isDragging = true;
                    startX = x;
                    card.style.transition = "none";
                    document.body.style.overflow = "hidden";
                };

                const updateDrag = (x) => {
                    if (!isDragging) return;
                    currentX = x - startX;
                    card.style.transform = `translate(calc(-50% + ${currentX}px), 0) rotate(${currentX * 0.05}deg)`;
                };

                const endDrag = () => {
                    if (!isDragging) return;
                    isDragging = false;
                    document.body.style.overflow = "";

                    if (currentX > 100) {
                        card.style.transition = "transform 0.3s ease";
                        card.style.transform = "translate(calc(-50% + 500px), 0) rotate(20deg)";
                        sendMatch(profile.ID, "like");
                        setTimeout(() => {
                            card.remove();
                            renderProfile(index + 1);
                        }, 300);
                    } else if (currentX < -100) {
                        card.style.transition = "transform 0.3s ease";
                        card.style.transform = "translate(calc(-50% - 500px), 0) rotate(-20deg)";
                        sendMatch(profile.ID, "dislike");
                        setTimeout(() => {
                            card.remove();
                            renderProfile(index + 1);
                        }, 300);
                    } else {
                        card.style.transition = "transform 0.3s ease";
                        card.style.transform = "translate(-50%, 0) rotate(0)";
                    }
                };

                // Souris
                card.addEventListener("mousedown", (e) => {
                    if (isTouchDevice) return;
                    startDrag(e.clientX);
                    const onMouseMove = (e) => updateDrag(e.clientX);
                    const onMouseUp = () => {
                        endDrag();
                        document.removeEventListener("mousemove", onMouseMove);
                        document.removeEventListener("mouseup", onMouseUp);
                    };
                    document.addEventListener("mousemove", onMouseMove);
                    document.addEventListener("mouseup", onMouseUp);
                });

                // Tactile
                card.addEventListener("touchstart", (e) => {
                    if (e.touches.length > 1) return;
                    isTouchDevice = true;
                    startDrag(e.touches[0].clientX);
                });

                card.addEventListener("touchmove", (e) => {
                    if (e.touches.length > 1) return;
                    e.preventDefault();
                    updateDrag(e.touches[0].clientX);
                }, { passive: false });

                card.addEventListener("touchend", () => {
                    endDrag();
                });

                container.appendChild(card);
            }

            renderProfile(currentIndex);

        } catch (err) {
            console.error("Erreur fetch :", err);
            container.innerHTML = "<p>Erreur lors de la récupération des profils.</p>";
        }
    });

    async function sendMatch(studentId, action) {
        try {
            const res = await fetch("/public/api/match_recruiter.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ student_id: studentId, action })
            });
            const data = await res.json();
            if (data.match) alert("🎉 Vous avez un match ! 🎉");
        } catch (e) {
            console.error("Erreur API match :", e);
        }
    }

    // Aide
    const helpBtn = document.getElementById("help-btn");
    const helpPopup = document.getElementById("help-popup");
    const closeHelp = document.getElementById("close-help");

    if (helpBtn && helpPopup && closeHelp) {
        helpBtn.addEventListener("click", () => helpPopup.classList.remove("hidden"));
        closeHelp.addEventListener("click", () => helpPopup.classList.add("hidden"));
    }
});