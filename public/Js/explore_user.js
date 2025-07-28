document.addEventListener("DOMContentLoaded", async () => {
    const container = document.getElementById("card-container");
    if (!container || recruiterId === null) return;

    try {
        const res = await fetch("/public/api/get_recruiter_data.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ recruiter_id: recruiterId })
        });

        const profiles = await res.json();
        container.innerHTML = "";

        if (!profiles.length) {
            container.innerHTML = "<p>Aucun utilisateur n'a encore liké vos offres.</p>";
            return;
        }

        let currentIndex = 0;

        function renderProfile(index) {
            if (index >= profiles.length) {
                container.innerHTML = "<p>Plus de profils à afficher.</p>";
                return;
            }

            const profile = profiles[index];
            const card = document.createElement("div");
            card.classList.add("card");
            card.style.zIndex = profiles.length - index;

            card.innerHTML = `
                <h2>${profile.Name}</h2>
                <p>Email : ${profile.Email}</p>
                <p>Description : ${profile.user_description || "Non renseignée"}</p>
            `;

            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            const onMouseMove = (e) => {
                if (!isDragging) return;
                currentX = e.clientX - startX;
                card.style.transform = `translateX(${currentX}px) rotate(${currentX * 0.05}deg)`;
            };

            const onMouseUp = () => {
                if (!isDragging) return;
                isDragging = false;
                document.removeEventListener("mousemove", onMouseMove);
                document.removeEventListener("mouseup", onMouseUp);

                if (currentX > 100) {
                    card.style.transition = "transform 0.3s ease";
                    card.style.transform = "translateX(500px) rotate(20deg)";
                    setTimeout(() => {
                        card.remove();
                        renderProfile(index + 1);
                    }, 300);
                } else if (currentX < -100) {
                    card.style.transition = "transform 0.3s ease";
                    card.style.transform = "translateX(-500px) rotate(-20deg)";
                    setTimeout(() => {
                        card.remove();
                        renderProfile(index + 1);
                    }, 300);
                } else {
                    card.style.transition = "transform 0.3s ease";
                    card.style.transform = "translateX(0) rotate(0)";
                }
            };

            card.addEventListener("mousedown", (e) => {
                isDragging = true;
                startX = e.clientX;
                card.style.transition = "none";
                document.addEventListener("mousemove", onMouseMove);
                document.addEventListener("mouseup", onMouseUp);
            });

            container.appendChild(card);
        }

        renderProfile(currentIndex);
    } catch (error) {
        console.error("Erreur lors du chargement des profils :", error);
        container.innerHTML = "<p>Erreur lors de la récupération des profils.</p>";
    }

    // Gestion du bouton d’aide
    document.getElementById("help-btn")?.addEventListener("click", () => {
        document.getElementById("help-popup")?.classList.remove("hidden");
    });
    document.getElementById("close-help")?.addEventListener("click", () => {
        document.getElementById("help-popup")?.classList.add("hidden");
    });
});