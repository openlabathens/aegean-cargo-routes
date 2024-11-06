const carousel = document.querySelector('.carousel');
const items = document.querySelectorAll('.carousel-item');

carousel.addEventListener('scroll', () => {
  let minDiff = Infinity;
  let closestItem = null;

  items.forEach((item) => {
    const itemCenter = item.getBoundingClientRect().top + item.offsetHeight / 2;
    const carouselCenter = carousel.getBoundingClientRect().top + carousel.offsetHeight / 2;
    const diff = Math.abs(carouselCenter - itemCenter);

    if (diff < minDiff) {
      minDiff = diff;
      closestItem = item;
    }
  });

  items.forEach((item) => item.classList.remove('active'));
  if (closestItem) {
    closestItem.classList.add('active');
  }
});