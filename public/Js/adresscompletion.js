"user strict";

document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("adresse");
    const suggestions = document.getElementById("suggestions");
  
    input.addEventListener("input", () => {
      const query = input.value.trim();
      if (query.length < 3) {
        suggestions.innerHTML = "";
        return;
      }
  
      fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`)
        .then(res => res.json())
        .then(data => {
          suggestions.innerHTML = "";
          if (data.features && data.features.length > 0) {
            data.features.forEach(feature => {
              const li = document.createElement("li");
              li.textContent = feature.properties.label;
              li.addEventListener("click", () => {
                input.value = feature.properties.label;
                suggestions.innerHTML = "";
              });
              suggestions.appendChild(li);
            });
          } else {
            suggestions.innerHTML = "<li>Aucune adresse trouvée</li>";
          }
        })
        .catch(err => {
          console.error("Erreur API:", err);
        });
    });
  
    document.addEventListener("click", (e) => {
      if (!suggestions.contains(e.target) && e.target !== input) {
        suggestions.innerHTML = "";
      }
    });
  });
  