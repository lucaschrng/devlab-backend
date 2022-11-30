const axios = require('axios');
const apiKey = 'b0c77f111b96a7cafe54d722516ddeff';

let searchInput = document.querySelector('#search-query');
let searchBtn = document.querySelector('.search-label');
let closeBtn = document.querySelector('.close-label');
let resultsDiv = document.querySelector('.results');
let resultsSection = document.querySelector('.results-section');
let main = document.querySelector('main');
let keywords = encodeURI(searchInput.value);

searchInput.addEventListener('keyup', () => {
    keywords = encodeURI(searchInput.value);
    elementsNb = resultsDiv.childElementCount;
    for (let i = 0; i < elementsNb; i++) {
        resultsDiv.removeChild(resultsDiv.firstChild)
    }
    if (keywords !== '') {
        searchMovies(keywords, 1);
    }
})

searchBtn.addEventListener('click', () => {
    resultsSection.classList.remove('hidden');
    main.classList.add('hidden');
    searchInput.focus();
})

closeBtn.addEventListener('click', () => {
    resultsSection.classList.add('hidden');
    main.classList.remove('hidden');
})

function searchMovies(keywords, page) {
    axios.get('https://api.themoviedb.org/3/search/movie?api_key=b0c77f111b96a7cafe54d722516ddeff&language=en-US&query=' + keywords + '&page= ' + page + '&include_adult=false')
    .then(function (response) {
        console.log(response.data.results);
        displayResults(response.data.results);
    })
    .catch(function (error) {
        console.log(error);
    })
}

function displayResults(movies) {
    movies.forEach(movie => {
        displayMovie(movie);
    });
    addEmptyDivs();
}

function displayMovie(movie) {
    if (typeof movie.poster_path === 'string') {
        let movieCard = document.createElement('div');
        movieCard.classList.add('max-w-[250px]', 'mt-6');
        let posterContainer = document.createElement('a');
        posterContainer.href = '/movie/' + movie.id;
        let poster = document.createElement('img');
        poster.classList.add('rounded');
        poster.src = 'https://image.tmdb.org/t/p/w300' + movie.poster_path;
        let infos = document.createElement('a');
        infos.classList.add('flex', 'flex-col', 'items-center', 'mt-2', 'text-xl', 'font-medium');
        infos.href = '/movie/' + movie.id;
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
        resultsDiv.appendChild(movieCard);
    }
}

function addEmptyDivs() {
    for (let i = 0; i < 8; i++) {
        let emptyDiv = document.createElement('div');
        emptyDiv.classList.add('w-[250px]', 'h-0');
        resultsDiv.appendChild(emptyDiv);
    }
}