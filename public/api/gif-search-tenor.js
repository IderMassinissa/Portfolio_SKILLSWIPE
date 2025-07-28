"use strict";

fetch('./Controllers/localisation_controller/createLocalisationJson.php');

const categorySelect = document.getElementById("categorySelect");
const searchBtn = document.getElementById("searchBtn");

window.onload = () => {
  loadCategories();
};

searchBtn.onclick = () => {
  const query = document.getElementById("searchInput").value || categorySelect.value;
  if (query) searchGifs(query);
};

async function loadCategories() {
  const res = await fetch(`https://tenor.googleapis.com/v2/categories?key=${TENOR_API_KEY}&client_key=demo`);
  const data = await res.json();
  data.tags.forEach(tag => {
    const option = document.createElement("option");
    option.value = tag.searchterm;
    option.textContent = tag.searchterm;
    categorySelect.appendChild(option);
  });
}

async function searchGifs(query) {
  const res = await fetch(`https://tenor.googleapis.com/v2/search?q=${encodeURIComponent(query)}&key=${TENOR_API_KEY}&limit=12&media_filter=gif`);
  const data = await res.json();

  const gifResults = document.getElementById("gifResults");
  gifResults.innerHTML = "";
  data.results.forEach(gif => {
    const img = document.createElement("img");
    img.src = gif.media_formats.gif.url;
    img.onclick = () => sendGif(gif.media_formats.gif.url);
    gifResults.appendChild(img);
  });
}

function sendGif(url) {
  const input = document.getElementById("inputMsg");
  
  if (input.value.length > 0) {
    input.value += "\n" + url;
  } else {
    input.value = url;
  }
}