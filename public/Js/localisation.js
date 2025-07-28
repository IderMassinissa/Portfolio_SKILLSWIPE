"use strict";

var lat = 0;
var lon = 0;
var macarte = null;
var markerClusters;

// Icônes personnalisées
var iconUtilisateur = L.icon({
	iconUrl: "./public/images/IconUser.png",
	iconSize: [30, 40],
	iconAnchor: [25, 50],
	popupAnchor: [0, -50],
});

var iconEntreprise = L.icon({
	iconUrl: "./public/images/IconEntreprise.png",
	iconSize: [30, 40],
	iconAnchor: [25, 50],
	popupAnchor: [0, -50],
});		

var iconEcole = L.icon({
	iconUrl: "./public/images/IconEcole.png",
	iconSize: [30, 40],
	iconAnchor: [25, 50],
	popupAnchor: [0, -50],
});	

// Fonction principale
function initMap(lieux) {
	var markers = []; 
	var bounds = [[41, -5.5], [52, 9.8]];
	
	macarte = L.map('map', {
		maxBounds: bounds,
		maxBoundsViscosity: 1,
		minZoom: 5.5,
		maxZoom: 18
	}).setView([lat, lon], 5.5);

	markerClusters = L.markerClusterGroup(); 

	L.geocoderBAN({ placeholder: "Chercher une adresse", collapsed: false }).addTo(macarte);
	
	L.tileLayer('https://tiles.stadiamaps.com/tiles/outdoors/{z}/{x}/{y}{r}.png?api_key=df20bfc9-a6d9-4b12-8c01-90a33d458b80', {
		attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
		minZoom: 1,
		maxZoom: 20
	}).addTo(macarte);

	for (let lieu in lieux) {
		var icone;
		var data = lieux[lieu];
		var id = data.id
		var logo = data.logo;
		var address = data.Address_Name;

		switch (data.type) {
			case "École":
				icone = iconEcole;
				break;
			case "Entreprise":
				icone = iconEntreprise;
				break;
			case "Utilisateur":
			default:
				icone = iconUtilisateur;
		}


		var marker = L.marker([data.lat, data.lon], { icon: icone });
		marker.bindPopup(`
			<a href="/user_profile?id=${id}" class="details">
				<div class="custom-popup">
					<img src="${logo}" height="50" width="50" class="user-map-pic"/>
					<h4>${lieu}</h4>
				</div>
				<p>${address}</p>
			</a>
		`, { className: "my-popup" });

		markerClusters.addLayer(marker);
		markers.push(marker);
	}
	macarte.addLayer(markerClusters);
}

// Charger les données JSON
window.onload = function() {
	fetch('./Controllers/offres_controller/createLocalisationJson.php')
		.then(response => response.json())
		.then(lieux => {
			initMap(lieux);
		})
		.catch(error => {
			console.error("Erreur de chargement des lieux :", error);
		});
};

