/* eslint-disable no-unused-vars */

// Example of the selected route data
const selectedRoute = {
  startingIsland: {
    name: "Alonisos",
    icon: "assets/islands/alonisos.png",
  },
  destinationIsland: {
    name: "Skopelos",
    icon: "assets/islands/skopelos.png",
  },
};

// Function to dynamically update the results page content
function updateResultsPage(route) {
  const startingIsland = document.getElementById("startingIsland");
  startingIsland.querySelector(".island-icon").src = route.startingIsland.icon;
  startingIsland.querySelector(".island-icon").alt =
    `${route.startingIsland.name} Icon`;
  // startingIsland.querySelector(".island-name").textContent = route.startingIsland.name;

  const destinationIsland = document.getElementById("destinationIsland");
  destinationIsland.querySelector(".island-icon").src =
    route.destinationIsland.icon;
  destinationIsland.querySelector(".island-icon").alt =
    `${route.destinationIsland.name} Icon`;
  // destinationIsland.querySelector(".island-name").textContent = route.destinationIsland.name;
}

function showResultsPage() {
  updateResultsPage(selectedRoute);
  // Display the results page
  document.getElementById("resultsPage").style.display = "block";
}
