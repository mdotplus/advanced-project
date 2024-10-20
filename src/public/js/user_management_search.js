const userSearchAuthoritySelect = document.querySelector('.title-group__search-box--authority');
const userSearchKeywordInput = document.querySelector('.title-group__search-box--keyword');

const userCardNameElements = document.querySelectorAll('.user-card__name--element');
const userCardNames = [];
for (let userCardNameElement of userCardNameElements) {
    userCardNames.push(userCardNameElement.textContent);
}

const userCardEmailElements = document.querySelectorAll('.user-card__email--element');
const userCardEmails = [];
for (let userCardEmailElement of userCardEmailElements) {
    userCardEmails.push(userCardEmailElement.textContent);
}

const userCardIdElements = document.querySelectorAll('.user-card__id');
const userCardIds = [];
for (let userCardIdElement of userCardIdElements) {
    userCardIds.push(userCardIdElement.textContent);
}

const userCardAuthorityElements = document.querySelectorAll('.user-card__authority--element');
const userCardAuthoritys = [];
for (let userCardAuthorityElement of userCardAuthorityElements) {
    userCardAuthoritys.push(userCardAuthorityElement.textContent);
}

function searchByKeyword(userTargetText) {
    let resultUserNameIds = [];
    for (let i = 0; i < userCardNames.length; i++) {
        if (userCardNames[i].indexOf(userTargetText) !== -1 || userTargetText === '') {
            resultUserNameIds.push(userCardIds[i]);
        }
    };

    let resultUserEmailIds = [];
    for (let i = 0; i < userCardEmails.length; i++) {
        if (userCardEmails[i].indexOf(userTargetText) !== -1 || userTargetText === '') {
            resultUserEmailIds.push(userCardIds[i]);
        }
    };

    const resultAllIds = resultUserNameIds.concat(resultUserEmailIds);
    const resultIds = resultAllIds.filter((element, index) => {
        return resultAllIds.indexOf(element) === index;
    })

    return resultIds;
}

function searchByAuthority(userTargetAuthority) {
    let resultIds = [];
    for (let i = 0; i < userCardAuthoritys.length; i++) {
        if (userCardAuthoritys[i] === userTargetAuthority || userTargetAuthority === 'All authority') {
            resultIds.push(userCardIds[i]);
        }
    };

    return resultIds;
}

function refineUserSearchCriteria(authoritySearchedIds, keywordSearchedIds) {
    let filteredIds = [];
    for (let i = 0; i < authoritySearchedIds.length; i++) {
        let index = keywordSearchedIds.indexOf(authoritySearchedIds[i]);
        if (index !== -1) {
            filteredIds.push(keywordSearchedIds[index]);
        }
    }

    return filteredIds;
}

function updateUserView() {
    const userTargetAuthority = userSearchAuthoritySelect.value;
    const userTargetText = userSearchKeywordInput.value;

    const refinedUserIds = refineUserSearchCriteria(
        searchByAuthority(userTargetAuthority),
        searchByKeyword(userTargetText)
    );

    for (let i = 0; i < userCardIds.length; i++) {
        document.querySelector(`.user-card-${userCardIds[i]}`).style.display = 'none';
    }
    for (let i = 0; i < refinedUserIds.length; i++) {
        document.querySelector(`.user-card-${refinedUserIds[i]}`).style.display = 'block';
    }
}

userSearchAuthoritySelect.addEventListener('input', () => {
    updateUserView();
});

userSearchKeywordInput.addEventListener('input', () => {
    updateUserView();
});
