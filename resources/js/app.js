//import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

const axios = require('axios');
const apiKey = 'b0c77f111b96a7cafe54d722516ddeff';

let searchOpened = false;
let searchInput = document.querySelector('#search-query');
let searchBtn = document.querySelector('.search-label');
let closeBtn = document.querySelector('.close-label');
let resultsDiv = document.querySelector('.results');
let resultsSection = document.querySelector('.results-section');
let query = document.querySelector('.query');
let main = document.querySelector('main');
let keywords = encodeURI(searchInput.value);
let carousels = document.querySelectorAll('.carousel');
let bestMovies = document.querySelector('.best-movies');
let bestPrevious = document.querySelector('.best-movies-container > .previous-button');
let bestNext = document.querySelector('.best-movies-container > .next-button');
let translate = [];

searchInput.addEventListener('keyup', () => {
    keywords = encodeURI(searchInput.value);
    query.innerHTML = searchInput.value;
    if (keywords !== '') {
        searchMovies(keywords, 1);
    }
})

searchBtn.addEventListener('click', () => {
    searchOpened = true;
    resultsSection.classList.remove('hidden');
    main.classList.add('hidden');
    searchInput.focus();
})

searchInput.addEventListener('focus', () => {
    console.log(searchOpened);
    if (!searchOpened) {
        searchBtn.click();
        searchOpened = true;
    }
})

closeBtn.addEventListener('click', () => {
    searchOpened = false;
    resultsSection.classList.add('hidden');
    main.classList.remove('hidden');
})

carousels.forEach((carousel, index) => {
    translate[index] = 0;
    let moviesDiv = carousel.children[2];
    let nextBtn = carousel.children[1];
    let previousBtn = carousel.children[0];
    let movieCards = Array.from(moviesDiv.children);
    nextBtn.addEventListener('click', () => {
        if (translate[index] < moviesDiv.childElementCount - 1) {
            translate[index]++;
        }
        movieCards.forEach(movieCard => {
            movieCard.style.translate = 'calc(' + (-translate[index] * 100) + '% + ' + (-translate[index] * 1.5) + 'rem)';
        });
    })

    previousBtn.addEventListener('click', () => {
        if (translate[index] > 0) {
            translate[index]--;
        }
        movieCards.forEach(movieCard => {
            movieCard.style.translate = 'calc(' + (-translate[index] * 100) + '% + ' + (-translate[index] * 1.5) + 'rem)';
        });
    })
})

function searchMovies(keywords, page) {
    axios.get('https://api.themoviedb.org/3/search/movie?api_key=' + apiKey + '&language=en-US&query=' + keywords + '&page= ' + page + '&include_adult=false')
    .then(function (response) {
        let elementsNb = resultsDiv.childElementCount;
        for (let i = 0; i < elementsNb; i++) {
            resultsDiv.removeChild(resultsDiv.firstChild)
        }
        displayResults(response.data.results);
    })
    .catch(function (error) {
        console.log(error);
    })
}

function displayResults(movies) {
    movies.forEach(movie => {
        displayMovie(movie, resultsDiv);
    });
    addEmptyDivs();
}

function displayMovie(movie, container) {
    if (typeof movie.poster_path === 'string') {
        let movieCard = document.createElement('div');
        movieCard.classList.add('min-w-[250px]', 'max-w-[250px]', 'mt-10', 'transition-all', 'duration-300');
        let posterContainer = document.createElement('a');
        posterContainer.href = '/movie/' + movie.id;
        let poster = document.createElement('img');
        poster.classList.add('rounded');
        poster.src = 'https://image.tmdb.org/t/p/w300' + movie.poster_path;
        let infos = document.createElement('a');
        infos.classList.add('flex', 'flex-col', 'items-center', 'mt-2', 'text-xl', 'font-medium');
        infos.href = '/movie.blade.php/' + movie.id;
        let title = document.createElement('span');
        title.innerHTML = movie.title;
        title.classList.add('max-w-full', 'whitespace-nowrap', 'overflow-hidden', 'text-ellipsis')
        let year = document.createElement('span');
        year.classList.add('opacity-40')
        if (typeof movie.release_date === 'string') {
            year.innerHTML = movie.release_date.slice(0, 4);
        } else {
            year.innerHTML = 'TBD';
        }
        infos.appendChild(title);
        infos.appendChild(year);
        posterContainer.appendChild(poster);
        movieCard.appendChild(posterContainer);
        movieCard.appendChild(infos);
        container.appendChild(movieCard);
    }
}

function addEmptyDivs() {
    for (let i = 0; i < 8; i++) {
        let emptyDiv = document.createElement('div');
        emptyDiv.classList.add('w-[250px]', 'h-0');
        resultsDiv.appendChild(emptyDiv);
    }
}

Alpine.start();

