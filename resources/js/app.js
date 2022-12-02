const axios = require('axios');
const apiKey = 'b0c77f111b96a7cafe54d722516ddeff';

let searchInput = document.querySelector('#search-query');
let searchBtn = document.querySelector('.search-label');
let closeBtn = document.querySelector('.close-label');
let resultsDiv = document.querySelector('.results');
let resultsSection = document.querySelector('.results-section');
let query = document.querySelector('.query');
let sort = document.querySelector('.select-sort');
let main = document.querySelector('main');
let keywords = encodeURI(searchInput.value);
let bestMovies = document.querySelector('.best-movies');
let bestPrevious = document.querySelector('.best-movies-container > .previous-button');
let bestNext = document.querySelector('.best-movies-container > .next-button');
let translate = 0;

searchInput.addEventListener('keyup', () => {
    keywords = encodeURI(searchInput.value);
    query.innerHTML = searchInput.value;
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

sort.addEventListener('change', () => {
    keywords = encodeURI(searchInput.value);
    query.innerHTML = searchInput.value;
    if (keywords !== '') {
        searchMovies(keywords, 1);
    }
})

if (bestMovies !== null) {
    searchBest();

    bestNext.addEventListener('click', () => {
        if (translate < 19) {
            translate++;
        }
        console.log(document.querySelectorAll('.best-movies > *'));
        document.querySelectorAll('.best-movies > *').forEach(movieCard => {
            movieCard.style.translate = 'calc(' + (-translate * 100) + '% + ' + (-translate * 1.5) + 'rem)';
        });
    })

    bestPrevious.addEventListener('click', () => {
        if (translate > 0) {
            translate--;
        }
        console.log(document.querySelectorAll('.best-movies > *'));
        document.querySelectorAll('.best-movies > *').forEach(movieCard => {
            movieCard.style.translate = 'calc(' + (-translate * 100) + '% + ' + (-translate * 1.5) + 'rem)';
        });
    })
}

function searchMovies(keywords, page) {
    axios.get('https://api.themoviedb.org/3/search/movie?api_key=b0c77f111b96a7cafe54d722516ddeff&language=en-US&query=' + keywords + '&page= ' + page + '&include_adult=false')
    .then(function (response) {
        elementsNb = resultsDiv.childElementCount;
        for (let i = 0; i < elementsNb; i++) {
            resultsDiv.removeChild(resultsDiv.firstChild)
        }
        console.log(response.data.results);
        displayResults(response.data.results);
    })
    .catch(function (error) {
        console.log(error);
    })
}

function searchBest() {
    axios.get('https://api.themoviedb.org/3/discover/movie?api_key=b0c77f111b96a7cafe54d722516ddeff&language=en-US&sort_by=vote_average.desc&include_adult=false&include_video=false&page=1&vote_count.gte=10000&with_watch_monetization_types=flatrate')
    .then(function (response) {
        elementsNb = bestMovies.childElementCount;
        for (let i = 0; i < elementsNb; i++) {
            bestMovies.removeChild(bestMovies.firstChild)
        }
        console.log(response.data.results);
        response.data.results.forEach(movie => {
            displayMovie(movie, bestMovies);
        })
    })
    .catch(function (error) {
        console.log(error);
    })
}

function displayResults(movies) {
    if (sort.value === 'name') {
        movies.sort((a, b) => a.title.localeCompare(b.title));
    } else if (sort.value === 'popularity') {
        movies.sort((a, b) => b.popularity - a.popularity);
    } else if (sort.value === 'rating') {
        movies.sort((a, b) => b.vote_average - a.vote_average);
    }
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
