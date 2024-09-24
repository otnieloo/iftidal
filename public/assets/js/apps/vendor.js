FilePond.registerPlugin(FilePondPluginImagePreview);

// Get a reference to the file input element
const inputElement = document.querySelector('input[type="file"]');

// Create a FilePond instance
const pond = FilePond.create(inputElement, {
  allowImagePreview: true,
  server: {
    url: CORE.baseUrl,
    process: {
      url: "/uploadimage",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
    },
    revert: {
      url: "/revertupload",
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": CORE.csrfToken,
      },
      body: JSON.stringify({
        test: "asd",
      }),
    },
  },
});

const latitude = document.getElementById("latitude");
const longitude = document.getElementById("longitude");
const type = document.getElementById("type");

var map = L.map("map").setView([51.505, -0.09], 13);

L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution:
    '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
}).addTo(map);

// Create a marker
let marker;

if (navigator.geolocation) {
  if (type.value === "create") {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        // Success callback
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        // Set map view to the user's location
        map.setView([lat, lng], 13);

        // Add a marker at the user's location
        marker = L.marker([lat, lng]).addTo(map);

        latitude.value = lat;
        longitude.value = lng;
      },
      function (error) {
        // Error callback
        console.error("Error getting location", error);
        alert("Unable to retrieve your location.");
      }
    );
  }
} else {
  alert("Geolocation is not supported by this browser.");
}

if (type.value === "edit") {
  map.setView([latitude.value, longitude.value], 13);
  marker = L.marker([latitude.value, longitude.value]).addTo(map);
}

const readonly = document.getElementById("readonly");

if (!readonly) {
  map.on("click", function (e) {
    // Get the coordinates where the user clicked
    const latlng = e.latlng;

    if (marker) {
      map.removeLayer(marker);
    }

    // Create a marker at the clicked location
    marker = L.marker([latlng.lat, latlng.lng]).addTo(map);

    latitude.value = latlng.lat;
    longitude.value = latlng.lng;
  });
}

const togglePassword = document.querySelectorAll(".togglepassword");

if (togglePassword.length) {
  togglePassword.forEach((pass) => {
    pass.addEventListener("click", function (e) {
      const inputPassword =
        e.target.parentElement.parentElement.previousElementSibling;

      const isChecked = e.target.checked;

      if (isChecked) {
        inputPassword.type = "text";
      } else {
        inputPassword.type = "password";
      }
    });
  });
}
