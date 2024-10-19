const shopModal = document.querySelector('.shop-modal__layer');
const shopModalButtonsEdit = document.querySelectorAll('.shop-edit-menu__modify-button');
const shopModalCloses = document.querySelectorAll('.shop-modal__contents--button-close');

shopModalButtonsEdit.forEach(button => {
    button.addEventListener('click', () => {
        shopModal.classList.add('is-open');

        const values = button.value.split(',');
        console.log(values);

        const shopIdElement = document.querySelector('.shop-modal__contents--items-shop-id');
        shopIdElement.value = values[0];

        const shopNameElement = document.querySelector('.shop-modal__contents--items-shop-name');
        shopNameElement.textContent = values[1];

        const shopAreaElement = document.querySelector('.shop-modal__contents--items-area');
        const areaId = values[2];
        shopAreaElement.options[areaId - 1].selected = true;

        const shopCategoryElement = document.querySelector('.shop-modal__contents--items-category');
        const categoryId = values[3];
        shopCategoryElement.options[categoryId - 1].selected = true;

        const shopProfileElement = document.querySelector('.shop-modal__contents--items-profile');
        shopProfileElement.textContent = values[4];
    })
});

shopModalCloses.forEach(close => {
    close.addEventListener('click', () => {
        shopModal.classList.remove('is-open');
    })
});
