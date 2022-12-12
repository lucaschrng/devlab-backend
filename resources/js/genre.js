let sort = document.querySelector('.sort-select');
let filter = document.querySelector('.filter-select');

console.log(filter);

filter.addEventListener('change', () => {
    window.location = "../" + filter.value + '/1';
})
