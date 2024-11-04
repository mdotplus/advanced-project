const selectDate = document.querySelector('.reservation__date');
const selectTime = document.querySelector('.reservation__time');
const selectNumber = document.querySelector('.reservation__number');
const summaryDate = document.querySelector('.reservation__summary--contents-date');
const summaryTime = document.querySelector('.reservation__summary--contents-time');
const summaryNumber = document.querySelector('.reservation__summary--contents-number');

const now = new Date();
const tomorrowTimestamp = now.setDate(now.getDate() + 1);
const tomorrow = new Date(tomorrowTimestamp);
const tomorrowFormatted = [
    tomorrow.getFullYear(),
    ('00' + (tomorrow.getMonth() + 1)).slice(-2),
    ('00' + (tomorrow.getDate())).slice(-2)
].join('-');

selectDate.setAttribute('min', tomorrowFormatted);

if (selectDate.value) {
    summaryDate.textContent = selectDate.value;
}
if (selectTime.value) {
    summaryTime.textContent = selectTime.value;
}
if (selectNumber.value) {
    summaryNumber.textContent = selectNumber.value + '人';
}

selectDate.addEventListener('input', () => {
    summaryDate.textContent = selectDate.value;
});
selectTime.addEventListener('input', () => {
    summaryTime.textContent = selectTime.value;
});
selectNumber.addEventListener('input', () => {
    summaryNumber.textContent = selectNumber.value + '人';
});
