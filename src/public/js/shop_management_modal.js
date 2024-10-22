// 店舗情報編集用モーダル
const shopEditModal = document.querySelector('.shop-modal__layer');
const shopEditModalButtonsEdit = document.querySelectorAll('.shop-edit-menu__modify-button');
const shopEditModalCloses = document.querySelectorAll('.shop-modal__contents--button-close');

shopEditModalButtonsEdit.forEach(button => {
    button.addEventListener('click', () => {
        shopEditModal.classList.add('is-open');

        const values = button.value.split(',');

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

shopEditModalCloses.forEach(close => {
    close.addEventListener('click', () => {
        shopEditModal.classList.remove('is-open');
    })
});

// 予約詳細確認用モーダル
const shopReservationsModal = document.querySelector('.shop-reservations-modal__layer');
const shopReservationsModalButtonsShow = document.querySelectorAll('.shop-card__reservation--detail-button');
const shopReservationsModalCloses = document.querySelectorAll('.shop-reservations-modal__contents--button-close');

const shopName = document.querySelector('.shop-reservations-modal__contents--items-shop-name');
const shopArea = document.querySelector('.shop-reservations-modal__contents--items-area');
const shopGenre = document.querySelector('.shop-reservations-modal__contents--items-genre');

const noTable = document.querySelector('.shop-reservations-modal__contents--items-no-table');
const tableHead = document.querySelector('.shop-reservations-modal__contents--items-table-head');
const tableBody = document.querySelector('.shop-reservations-modal__contents--items-table-body');

shopReservationsModalButtonsShow.forEach(button => {
    button.addEventListener('click', () => {
        shopReservationsModal.classList.add('is-open');
        tableBody.textContent = '';

        const values = button.value;
        if (values === 'no data') {
            noTable.style.display = '';
            tableHead.style.display = 'none';
            tableBody.style.display = 'none';

            return;
        }

        const values2 = values
            .replace('[', '')
            .replace(']', '')
            .replace(/},{/g, '}},{{')
            .replace(/"/g, '')
            .split('},{')
            .map(value => {
                return value.replace('{', '')
                    .replace('}', '')
                    .split(',');
            });
        console.log(values2);
        const realValue = [];
        values2.forEach(value => {
            const tmp = [];
            tmp.date = value[3].replace('date:', '');
            tmp.time = value[4].replace('time:', '').replace(':00', '');
            tmp.number = value[5].replace('number:', '');
            tmp.shopName = value[10].replace('shop_name:', '')
                .replace(/\\u.{4}/g, char => {
                    return String.fromCharCode(parseInt(char.replace('\\u', '0x')));
                });
            tmp.shopArea = value[11].replace('shop_area:', '')
                .replace(/\\u.{4}/g, char => {
                    return String.fromCharCode(parseInt(char.replace('\\u', '0x')));
                });
            tmp.shopGenre = value[12].replace('shop_genre:', '')
                .replace(/\\u.{4}/g, char => {
                    return String.fromCharCode(parseInt(char.replace('\\u', '0x')));
                });
            tmp.userName = value[13].replace('user_name:', '')
                .replace(/\\u.{4}/g, char => {
                    return String.fromCharCode(parseInt(char.replace('\\u', '0x')));
                });
            tmp.email = value[14].replace('user_email:', '');

            realValue.push(tmp);
        });
        console.log(realValue);

        const trFragment = document.createDocumentFragment();
        const tdFragment = document.createDocumentFragment();
        realValue.forEach(value => {
            shopName.textContent = value['shopName'];
            shopArea.textContent = value['shopArea'];
            shopGenre.textContent = value['shopGenre'];

            const tdDate = document.createElement('td');
            tdDate.appendChild(document.createTextNode(value['date']));
            tdFragment.appendChild(tdDate);

            const tdTime = document.createElement('td');
            tdTime.appendChild(document.createTextNode(value['time']));
            tdFragment.appendChild(tdTime);

            const tdNumber = document.createElement('td');
            tdNumber.appendChild(document.createTextNode(value['number'] + '人'));
            tdFragment.appendChild(tdNumber);

            const tdName = document.createElement('td');
            tdName.appendChild(document.createTextNode(value['userName']));
            tdFragment.appendChild(tdName);

            const tdEmail = document.createElement('td');
            tdEmail.appendChild(document.createTextNode(value['email']));
            tdFragment.appendChild(tdEmail);

            const tr = document.createElement('tr');
            tr.appendChild(tdFragment);
            trFragment.appendChild(tr);
        });

        noTable.style.display = 'none';
        tableHead.style.display = '';
        tableBody.style.display = '';

        tableBody.appendChild(trFragment);
        shopReservationsModal.classList.add('is-open');
    })
});

shopReservationsModalCloses.forEach(close => {
    close.addEventListener('click', () => {
        shopReservationsModal.classList.remove('is-open');
    })
});
