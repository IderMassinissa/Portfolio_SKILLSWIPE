import { fetchOffers, sendMatch } from './swipe_api.js';

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("filter-form");
    const container = document.getElementById("card-container");

    if (!form || !container) return;

    let currentIndex = 0;
    let currentOffers = [];
    let isTouchDevice = false;

    function showNextCard() {
        container.innerHTML = "";

        const offer = currentOffers[currentIndex];
        if (!offer) {
            container.innerHTML = "<p>Plus d'offres à afficher.</p>";
            return;
        }

        const card = document.createElement("div");
        card.classList.add("card");

        card.innerHTML = `
            <img src="/public/images/default_missing_picture.png" alt="logo">
            <h2>${offer.Title}</h2>
            <p>${offer.company}</p>
            <button class="btn btn-submit btn-details" data-id="${offer.offer_id}">Détails</button>
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
            card.style.transform = `translateX(${currentX}px) rotate(${currentX * 0.05}deg)`;
        };

        const endDrag = () => {
            if (!isDragging) return;
            isDragging = false;
            document.body.style.overflow = "";

            if (currentX > 100) {
                card.style.transition = "transform 0.3s ease";
                card.style.transform = "translateX(500px) rotate(20deg)";
                sendMatch({ offer_id: offer.offer_id, action: "like" });
                setTimeout(() => {
                    currentIndex++;
                    showNextCard();
                }, 300);
            } else if (currentX < -100) {
                card.style.transition = "transform 0.3s ease";
                card.style.transform = "translateX(-500px) rotate(-20deg)";
                sendMatch({ offer_id: offer.offer_id, action: "dislike" });
                setTimeout(() => {
                    currentIndex++;
                    showNextCard();
                }, 300);
            } else {
                card.style.transition = "transform 0.3s ease";
                card.style.transform = "translateX(0) rotate(0)";
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
            updateDrag(e.touches[0].clientX);
        });

        card.addEventListener("touchend", () => {
            endDrag();
        });

        container.appendChild(card);
    }

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        try {
            const offers = await fetchOffers(formData);
            container.innerHTML = "";

            if (!offers.length) {
                container.innerHTML = "<p>Aucune offre trouvée.</p>";
                return;
            }

            currentOffers = offers;
            currentIndex = 0;
            showNextCard();
        } catch (error) {
            console.error("Erreur API :", error);
            container.innerHTML = "<p>Erreur lors de la récupération des offres.</p>";
        }
    });

    // Aide
    const helpBtn = document.getElementById("help-btn");
    const helpPopup = document.getElementById("help-popup");
    const closeHelp = document.getElementById("close-help");

    if (helpBtn && helpPopup && closeHelp) {
        helpBtn.addEventListener("click", () => helpPopup.classList.remove("hidden"));
        closeHelp.addEventListener("click", () => helpPopup.classList.add("hidden"));
    }

    // Détails
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("btn-details")) {
            const offerId = e.target.dataset.id;
            const offer = currentOffers.find(o => o.offer_id == offerId);

            if (offer) {
                document.getElementById("popup-title").textContent = offer.Title;
                document.getElementById("popup-company").textContent = offer.company;
                document.getElementById("popup-description").textContent = offer.Description || "Pas de description.";
                document.getElementById("popup").classList.remove("hidden");
            }
        }

        if (e.target.id === "close-popup") {
            document.getElementById("popup").classList.add("hidden");
        }
    });
});