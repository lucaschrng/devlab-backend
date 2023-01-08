//import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

const axios = require('axios');
const apiKey = 'b0c77f111b96a7cafe54d722516ddeff';

let searchOpened = false;
let searchInput = document.querySelector('#search-query');
let searchBtn = document.querySelector('.search-label');
let closeBtn = document.querySelector('.close-label');
let resultsUsers = document.querySelector('.usersResults');
let resultsDiv = document.querySelector('.results');
let resultsSection = document.querySelector('.results-section');
let query = document.querySelector('.query');
let main = document.querySelector('main');
let keywords = encodeURI(searchInput.value);
let carousels = document.querySelectorAll('.carousel');
let translate = [];
let addMovieButton = document.querySelector('.add-movie-button');
let addToAlbum = document.querySelectorAll('.add-to-album');
let albumIds = document.querySelectorAll('.album-id');
let movieId = document.querySelector('.movie-id');
let addPanel = document.querySelector('.add-panel');
let escape = document.querySelector('.escape');

if (movieId) {
    movieId = movieId.value;
    let index = 0;
    addToAlbum.forEach(addToAlbumButton => {
        let albumId = albumIds[index].value;
        addToAlbumButton.addEventListener('click', () => {
            addMovieToAlbum(movieId, albumId);
        });
        index++;
    })

    addMovieButton.addEventListener('click', () => {
            addPanel.classList.remove('hidden');
            escape.classList.remove('hidden');
    })

    escape.addEventListener('click', () => {
            addPanel.classList.add('hidden');
            escape.classList.add('hidden');
    })
}

function addMovieToAlbum(movieId, albumId) {
    axios.post(window.location.origin + '/api/add-movie?movie_id=' + movieId + '&album_id=' + albumId)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        })
}

searchInput.addEventListener('keyup', () => {
    keywords = encodeURI(searchInput.value);
    query.innerHTML = searchInput.value;
    if (keywords !== '') {
        searchUsers(keywords);
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
function searchUsers(keywords) {
    axios.get(window.location.origin + '/api/search/user/' + keywords)
        .then(function (response) {
            console.log(response);
            let elementsNb = resultsUsers.childElementCount;
            for (let i = 0; i < elementsNb; i++) {
                resultsUsers.removeChild(resultsUsers.firstChild)
            }
            if (response.data.length > 0) {
                displayUsers(response.data);
            } else {
                displayNoUser();
            }
        })
        .catch(function (error) {
            console.log(error);
        })
}

function displayUsers(users) {
    users.forEach(user => {
        let userCard = document.createElement('a');
        userCard.href = window.location.origin + '/user/' + user.username;
        userCard.classList.add('min-w-[250px]', 'max-w-[250px]', 'bg-white/10', 'p-4', 'flex', 'items-center', 'rounded');
        let userInitials = document.createElement('h2');
        userInitials.classList.add('h-[80px]', 'min-w-[80px]', 'bg-white/20', 'rounded-full', 'leading-[80px]', 'text-center', 'text-4xl');
        userInitials.innerHTML = user.firstName.substring(0, 1) + user.lastName.substring(0, 1);
        let userNames = document.createElement('h3');
        userNames.classList.add('text-xl', 'w-full', 'flex', 'justify-center');
        userNames.innerHTML = user.firstName + '<br>' + user.lastName;
        userCard.appendChild(userInitials);
        userCard.appendChild(userNames);
        resultsUsers.appendChild(userCard);
    })
    addEmptyDivs(resultsUsers);
}

function displayNoUser() {
    let message = document.createElement('p');
    message.classList.add('w-full', 'p-4', 'text-xl', 'text-center', 'bg-white/10', 'rounded');
    message.innerHTML = 'No user found';
    resultsUsers.appendChild(message);
}

function searchMovies(keywords, page) {
    axios.get('https://api.themoviedb.org/3/search/movie?api_key=' + apiKey + '&language=en-US&query=' + keywords + '&page= ' + page + '&include_adult=false')
    .then(function (response) {
        let elementsNb = resultsDiv.childElementCount;
        for (let i = 0; i < elementsNb; i++) {
            resultsDiv.removeChild(resultsDiv.firstChild)
        }
        console.log('hey');
        console.log(response.data.results.length)
        if (response.data.results.length > 0) {
            displayResults(response.data.results);
        } else {
            displayNoMovie();
        }
    })
    .catch(function (error) {
        console.log(error);
    })
}

function displayResults(movies) {
    movies.forEach(movie => {
        displayMovie(movie, resultsDiv);
    });
    addEmptyDivs(resultsDiv);
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

function displayNoMovie() {
    let message = document.createElement('p');
    message.classList.add('w-full', 'p-4', 'text-xl', 'text-center', 'bg-white/10', 'rounded');
    message.innerHTML = 'No movie found';
    resultsDiv.appendChild(message);
}

function addEmptyDivs(parent) {
    for (let i = 0; i < 8; i++) {
        let emptyDiv = document.createElement('div');
        emptyDiv.classList.add('w-[250px]', 'h-0');
        parent.appendChild(emptyDiv);
    }
}

if (addMovieButton) {
    addMovieButton.addEventListener('click', () => {

    })
}



Alpine.start();

