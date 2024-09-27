const searchInput = document.querySelector('.search-box__name');

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

searchInput.addEventListener('input', () => {
    const searchText = searchInput.value;
    for (let cardName of cardNames) {
        const cardId = cardIds[cardNames.indexOf(cardName)];
        console.log('target：' + cardName);
        if (cardName.indexOf(searchText) !== -1) {
            document.querySelector(`.card-${cardId}`).style.display = 'block';
        } else {
            document.querySelector(`.card-${cardId}`).style.display = 'none';
        }
    };
});
