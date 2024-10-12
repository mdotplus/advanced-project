const searchAuthoritySelect = document.querySelector('.title-group__search-box--authority');
const searchKeywordInput = document.querySelector('.title-group__search-box--keyword');

const cardNameElements = document.querySelectorAll('.user-card__name--element');
const cardNames = [];
for (let cardNameElement of cardNameElements) {
    cardNames.push(cardNameElement.textContent);
}

const cardEmailElements = document.querySelectorAll('.user-card__email--element');
const cardEmails = [];
for (let cardEmailElement of cardEmailElements) {
    cardEmails.push(cardEmailElement.textContent);
}

const cardIdElements = document.querySelectorAll('.user-card__id');
const cardIds = [];
for (let cardIdElement of cardIdElements) {
    cardIds.push(cardIdElement.textContent);
}

const cardAuthorityElements = document.querySelectorAll('.user-card__authority--element');
const cardAuthoritys = [];
for (let cardAuthorityElement of cardAuthorityElements) {
    cardAuthoritys.push(cardAuthorityElement.textContent);
}

function searchByKeyword(targetText) {
    let resultNameIds = [];
    for (let i = 0; i < cardNames.length; i++) {
        if (cardNames[i].indexOf(targetText) !== -1 || targetText === '') {
            resultNameIds.push(cardIds[i]);
        }
    };

    let resultEmailIds = [];
    for (let i = 0; i < cardEmails.length; i++) {
        if (cardEmails[i].indexOf(targetText) !== -1 || targetText === '') {
            resultEmailIds.push(cardIds[i]);
        }
    };

    const resultAllIds = resultNameIds.concat(resultEmailIds);
    const resultIds = resultAllIds.filter((element, index) => {
        return resultAllIds.indexOf(element) === index;
    })

    return resultIds;
}

function searchByAuthority(targetAuthority) {
    let resultIds = [];
    for (let i = 0; i < cardAuthoritys.length; i++) {
        if (cardAuthoritys[i] === targetAuthority || targetAuthority === 'All authority') {
            resultIds.push(cardIds[i]);
        }
    };

    return resultIds;
}

function refineSearchCriteria(authoritySearchedIds, keywordSearchedIds) {
    let filteredIds = [];
    for (let i = 0; i < authoritySearchedIds.length; i++) {
        let index = keywordSearchedIds.indexOf(authoritySearchedIds[i]);
        if (index !== -1) {
            filteredIds.push(keywordSearchedIds[index]);
        }
    }

    return filteredIds;
}

function updateView() {
    const targetAuthority = searchAuthoritySelect.value;
    const targetText = searchKeywordInput.value;

    const refinedIds = refineSearchCriteria(
        searchByAuthority(targetAuthority),
        searchByKeyword(targetText)
    );

    for (let i = 0; i < cardIds.length; i++) {
        document.querySelector(`.user-card-${cardIds[i]}`).style.display = 'none';
    }
    for (let i = 0; i < refinedIds.length; i++) {
        document.querySelector(`.user-card-${refinedIds[i]}`).style.display = 'block';
    }
}

searchAuthoritySelect.addEventListener('input', () => {
    updateView();
});

searchKeywordInput.addEventListener('input', () => {
    updateView();
});
