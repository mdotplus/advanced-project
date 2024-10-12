const userModal = document.querySelector('.user-modal__background');
const userModalButtonsEdit = document.querySelectorAll('.edit-menu__modify-button');
const userModalButtonsDelete = document.querySelectorAll('.edit-menu__delete-button');
const userModalCloses = document.querySelectorAll('.user-modal__contents--button-close');

userModalButtonsEdit.forEach(button => {
    button.addEventListener('click', () => {
        userModal.classList.add('is-open');

        const values = button.value.split(',');
        console.log(values);

        const userIdElement = document.querySelector('.user-modal__contents--items-user-id');
        userIdElement.value = values[0];
        const userNameElement = document.querySelector('.user-modal__contents--items-name');
        userNameElement.textContent = values[1];
        const userEmailElement = document.querySelector('.user-modal__contents--items-email');
        userEmailElement.textContent = values[2];
        const userAuthorityElement = document.querySelector('.user-modal__contents--items-authority');
        const authority = values[3];
        userAuthorityElement.options[authority - 1].selected = true;
    })
});

userModalCloses.forEach(close => {
    close.addEventListener('click', () => {
        userModal.classList.remove('is-open');
    })
});
