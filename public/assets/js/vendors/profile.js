const Profile = {
  latitude: document.querySelector('[name="latitude"]'),
  longitude: document.querySelector('[name="longitude"]'),

  map: false,
  marker: false,

  initMaps() {
    Profile.map = L.map("maps").setView([51.505, -0.09], 13);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution:
        '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(Profile.map);

    Profile.map.setView([Profile.latitude.value, Profile.longitude.value], 13);
    Profile.marker = L.marker([Profile.latitude.value, Profile.longitude.value]).addTo(Profile.map);

    Profile.map.on("click", function (e) {
      // Get the coordinates where the user clicked
      const latlng = e.latlng;

      if (Profile.marker) {
        Profile.map.removeLayer(Profile.marker);
      }

      // Create a marker at the clicked location
      Profile.marker = L.marker([latlng.lat, latlng.lng]).addTo(Profile.map);

      Profile.latitude.value = latlng.lat;
      Profile.longitude.value = latlng.lng;
    });
  }
};

document.addEventListener("DOMContentLoaded", function() {
  Profile.initMaps();
})
