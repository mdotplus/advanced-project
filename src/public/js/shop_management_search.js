const searchAreaSelect = document.querySelector('.title-group-second__search-box--area');
const searchGenreSelect = document.querySelector('.title-group-second__search-box--genre');
const searchNameInput = document.querySelector('.title-group-second__search-box--name');

const cardNameElements = document.querySelectorAll('.card__name');
const cardNames = [];
for (let cardNameElement of cardNameElements) {
    cardNames.push(cardNameElement.textContent);
}

const cardIdElements = document.querySelectorAll('.card__id');
const cardIds = [];
for (let cardIdElement of cardIdElements) {
    cardIds.push(cardIdElement.textContent);
}

const cardAreaElements = document.querySelectorAll('.card__hashtag--area');
const cardAreas = [];
for (let cardAreaElement of cardAreaElements) {
    cardAreas.push(cardAreaElement.textContent);
}

const cardGenreElements = document.querySelectorAll('.card__hashtag--category');
const cardGenres = [];
for (let cardGenreElement of cardGenreElements) {
    cardGenres.push(cardGenreElement.textContent);
}

function searchByName(targetText) {
    let resultIds = [];
    for (let i = 0; i < cardNames.length; i++) {
        if (cardNames[i].indexOf(targetText) !== -1 || targetText === '') {
            resultIds.push(cardIds[i]);
        }
    };

    return resultIds;
}

function searchByArea(targetArea) {
    let resultIds = [];
    for (let i = 0; i < cardAreas.length; i++) {
        if (cardAreas[i] === targetArea || targetArea === 'All area') {
            resultIds.push(cardIds[i]);
        }
    };

    return resultIds;
}

function searchByGenre(targetGenre) {
    let resultIds = [];
    for (let i = 0; i < cardGenres.length; i++) {
        if (cardGenres[i] === targetGenre || targetGenre === 'All genre') {
            resultIds.push(cardIds[i]);
        }
    };

    return resultIds;
}

function refineSearchCriteria(areaSearchedIds, genreSearchedIds, nameSearchedIds) {
    let idsFilteredByAreasAndGenres = [];
    for (let i = 0; i < areaSearchedIds.length; i++) {
        const index = genreSearchedIds.indexOf(areaSearchedIds[i]);
        if (index !== -1) {
            idsFilteredByAreasAndGenres.push(genreSearchedIds[index]);
        }
    }

    let filteredIds = [];
    for (let i = 0; i < idsFilteredByAreasAndGenres.length; i++) {
        const index = nameSearchedIds.indexOf(idsFilteredByAreasAndGenres[i]);
        if (index !== -1) {
            filteredIds.push(nameSearchedIds[index]);
        }
    }

    return filteredIds;
}

function updateView() {
    const targetArea = searchAreaSelect.value;
    const targetGenre = searchGenreSelect.value;
    const targetText = searchNameInput.value;

    const refinedIds = refineSearchCriteria(
        searchByArea(targetArea),
        searchByGenre(targetGenre),
        searchByName(targetText)
    );

    for (let i = 0; i < cardIds.length; i++) {
        document.querySelector(`.card-${cardIds[i]}`).style.display = 'none';
    }
    for (let i = 0; i < refinedIds.length; i++) {
        document.querySelector(`.card-${refinedIds[i]}`).style.display = 'block';
    }
}

searchAreaSelect.addEventListener('input', () => {
    updateView();
});

searchGenreSelect.addEventListener('input', () => {
    updateView();
});

searchNameInput.addEventListener('input', () => {
    updateView();
});
