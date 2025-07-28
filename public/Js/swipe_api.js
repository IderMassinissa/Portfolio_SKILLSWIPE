// Récupère les offres à swiper (étudiant)
export async function fetchOffers(formData) {
    const res = await fetch("/public/api/get_swipe_data.php", {
        method: "POST",
        body: formData
    });
    return res.json();
}

// Envoie un "like" ou "dislike" (étudiant)
export async function sendMatch({ offer_id, action }) {
    const res = await fetch("/public/api/match.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ offer_id, action })
    });
    return res.json();
}
