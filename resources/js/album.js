'use strict'


import Alpine from 'alpinejs';

window.Alpine = Alpine;

const axios = require('axios');

let albumSettings = document.querySelector(".settings-album")
let settingsSpan=document.querySelector(".settings-span")
let shareSpan=document.querySelector(".share-span")
let notifSpan=document.querySelector(".notifications")

let addAlbum = document.querySelector(".add-album")
let createAlbumSpan = document.querySelector(".create-album")
let shareAlbum =document.querySelector(".share-icon");
let resultsUser=document.querySelector(".resultsUser");
let mailIcon=document.querySelector(".mail-icon")

console.log(notifSpan)
if (addAlbum){
    addAlbum.addEventListener('click',function (){
        createAlbumSpan.classList.toggle('hidden');
        console.log("hey2")

    })
}
if (notifSpan) {
    mailIcon.addEventListener("click", function () {
        notifSpan.classList.toggle('hidden');
        console.log("hey2")
    })
    console.log("hey2")
}

if(albumSettings){
   albumSettings.addEventListener('click',function (){
        settingsSpan.classList.toggle('hidden');
    })
}

if (shareAlbum) {
    shareAlbum.addEventListener('click', function () {
        shareSpan.classList.toggle('hidden');
    })
}


// search user in album

let searchInput =document.querySelector(".search-input")
let keywords = encodeURI(searchInput.value);
let query = document.querySelector('.query');

searchInput.addEventListener('keyup', () => {
    keywords = encodeURI(searchInput.value);
    query.innerHTML = searchInput.value;
    if (keywords !== '') {
        searchUsers(keywords);
    }
})

function searchUsers(keywords) {
    axios.get(window.location.origin + '/api/search/user/' + keywords)
        .then(function (response) {
            console.log(response);
            let elementsNb = resultsUser.childElementCount;
            for (let i = 0; i < elementsNb; i++) {
                resultsUser.removeChild(resultsUser.firstChild)
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
        //let userDiv=document.createElement('div');
        let labeluserCard=document.createElement("label");
        let userCard = document.createElement('input');
        userCard.type='checkbox';
        userCard.value=user.id;
        userCard.setAttribute('name','invited_id')
        /*userCard.classList.add('min-w-[250px]', 'max-w-[250px]', 'bg-white/10', 'p-4', 'flex', 'items-center', 'rounded','checkbox-share-profile');*/
       // userDiv.classList.add('flex',"flex-row-reverse","items-start");
        labeluserCard.classList.add('flex',"flex-row")
        let userInitials = document.createElement('h2');
        userInitials.classList.add('h-[80px]', 'min-w-[80px]', 'bg-white/20', 'rounded-full', 'leading-[80px]', 'text-center', 'text-4xl');
        userInitials.innerHTML = user.firstName.substring(0, 1) + user.lastName.substring(0, 1);
        let userNames = document.createElement('h3');
        userNames.classList.add('text-xl', 'w-full', 'flex', 'justify-center');
        userNames.innerHTML = user.firstName + '<br>' + user.lastName;

        labeluserCard.appendChild(userInitials);
        labeluserCard.appendChild(userNames);
        resultsUser.appendChild(labeluserCard);
        resultsUser.appendChild(userCard);
        //resultsUser.appendChild(userDiv);
    })
    let sendButton=document.createElement('input');
    sendButton.type="submit";
    sendButton.value="share";
    resultsUser.appendChild(sendButton)
    addEmptyDivs(resultsUser);
}

function displayNoUser() {
    let message = document.createElement('p');
    message.classList.add('w-full', 'p-4', 'text-xl', 'text-center', 'bg-white/10', 'rounded');
    message.innerHTML = 'No user found';
    resultsUser.appendChild(message);
}

function addEmptyDivs(parent) {
    for (let i = 0; i < 8; i++) {
        let emptyDiv = document.createElement('div');
        emptyDiv.classList.add('w-[250px]', 'h-0');
        parent.appendChild(emptyDiv);
    }
}
