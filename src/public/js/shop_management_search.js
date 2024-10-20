const shopSearchAreaSelect = document.querySelector('.title-group-second__search-box--area');
const shopSearchGenreSelect = document.querySelector('.title-group-second__search-box--genre');
const shopSearchNameInput = document.querySelector('.title-group-second__search-box--name');

const shopCardNameElements = document.querySelectorAll('.shop-card__name--element');
const shopCardNames = [];
for (let cardNameElement of shopCardNameElements) {
    shopCardNames.push(cardNameElement.textContent);
}

const shopCardIdElements = document.querySelectorAll('.shop-card__id');
const shopCardIds = [];
for (let shopCardIdElement of shopCardIdElements) {
    shopCardIds.push(shopCardIdElement.textContent);
}

const shopCardAreaElements = document.querySelectorAll('.shop-card__area--element');
const shopCardAreas = [];
for (let shopCardAreaElement of shopCardAreaElements) {
    shopCardAreas.push(shopCardAreaElement.textContent);
}

const shopCardGenreElements = document.querySelectorAll('.shop-card__genre--element');
const shopCardGenres = [];
for (let shopCardGenreElement of shopCardGenreElements) {
    shopCardGenres.push(shopCardGenreElement.textContent);
}

function searchByName(shopTargetText) {
    let resultIds = [];
    for (let i = 0; i < shopCardNames.length; i++) {
        if (shopCardNames[i].indexOf(shopTargetText) !== -1 || shopTargetText === '') {
            resultIds.push(shopCardIds[i]);
        }
    };

    return resultIds;
}

function searchByArea(shopTargetArea) {
    let resultIds = [];
    for (let i = 0; i < shopCardAreas.length; i++) {
        if (shopCardAreas[i] === shopTargetArea || shopTargetArea === 'All area') {
            resultIds.push(shopCardIds[i]);
        }
    };

    return resultIds;
}

function searchByGenre(shopTargetGenre) {
    let resultIds = [];
    for (let i = 0; i < shopCardGenres.length; i++) {
        if (shopCardGenres[i] === shopTargetGenre || shopTargetGenre === 'All genre') {
            resultIds.push(shopCardIds[i]);
        }
    };

    return resultIds;
}

function refineShopSearchCriteria(areaSearchedIds, genreSearchedIds, nameSearchedIds) {
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

function updateShopView() {
    const shopTargetArea = shopSearchAreaSelect.value;
    const shopTargetGenre = shopSearchGenreSelect.value;
    const shopTargetText = shopSearchNameInput.value;

    const refinedShopIds = refineShopSearchCriteria(
        searchByArea(shopTargetArea),
        searchByGenre(shopTargetGenre),
        searchByName(shopTargetText)
    );

    for (let i = 0; i < shopCardIds.length; i++) {
        document.querySelector(`.shop-card-${shopCardIds[i]}`).style.display = 'none';
    }
    for (let i = 0; i < refinedShopIds.length; i++) {
        document.querySelector(`.shop-card-${refinedShopIds[i]}`).style.display = 'block';
    }
}

shopSearchAreaSelect.addEventListener('input', () => {
    updateShopView();
});

shopSearchGenreSelect.addEventListener('input', () => {
    updateShopView();
});

shopSearchNameInput.addEventListener('input', () => {
    updateShopView();
});
