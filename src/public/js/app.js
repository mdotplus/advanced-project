const modal = document.querySelector('.modal__background');
const modalButton = document.querySelector('.header__menu--button');
const modalClose = document.querySelector('.modal__contents--button-close');

modalButton.addEventListener('click', () => {
  modal.classList.add('is-open');
});

modalClose.addEventListener('click', () => {
  modal.classList.remove('is-open');
});
