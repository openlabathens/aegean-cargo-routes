document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".island-svg-container");
  const svg = document.querySelector(".island-svg");

  // Create spacers for padding
  const spacerTop = document.createElement("div");
  const spacerBottom = document.createElement("div");
  spacerTop.classList.add("spacer");
  spacerBottom.classList.add("spacer");

  // Clone the SVG twice for seamless infinite scrolling
  const clonedSVG1 = svg.cloneNode(true);
  const clonedSVG2 = svg.cloneNode(true);

  // Append spacers and cloned SVGs
  container.appendChild(spacerTop);
  container.appendChild(clonedSVG1);
  container.appendChild(clonedSVG2);
  container.appendChild(spacerBottom);

  // Set initial scroll position to the middle of the container
  container.scrollTop = container.scrollHeight / 3;

  container.addEventListener("scroll", () => {
    // Reset scroll position when reaching the top or bottom
    if (container.scrollTop <= 0) {
      container.scrollTop = container.scrollHeight / 3;
    } else if (container.scrollTop >= container.scrollHeight * (2 / 3)) {
      container.scrollTop = container.scrollHeight / 3;
    }
  });
});
