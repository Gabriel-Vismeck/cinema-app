const swiper = new Swiper('.swiper-destaques', {
  // Optional parameters
  direction: 'horizontal',
  slidesPerView: 4,
  spaceBetween: 69,
  autoHeight: true,
  loop: true,

  // If we need pagination
  pagination: {
    clickable: true,
    el: '.swiper-pagination-destaques',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next-destaques',
    prevEl: '.swiper-button-prev-destaques',
  },
});

const swiper2 = new Swiper('.swiper-cartaz', {
  // Optional parameters
  direction: 'horizontal',
  slidesPerView: 3,
  spaceBetween: 30,
  autoHeight: true,
  loop: true,

  // If we need pagination
  pagination: {
    clickable: true,
    el: '.swiper-pagination-cartaz',
  },
});

const swiper3 = new Swiper('.swiper-breve', {
  // Optional parameters
  direction: 'horizontal',
  slidesPerView: 3,
  spaceBetween: 30,
  autoHeight: true,
  loop: true,

  // If we need pagination
  pagination: {
    clickable: true,
    el: '.swiper-pagination-breve',
  },
});