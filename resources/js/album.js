'use strict'

const axios = require('axios');

let albumSettings = document.querySelector(".settings-album")
let settingsSpan=document.querySelector(".settings-span")
let publicToggle = document.querySelector("#toggle-example");

let addAlbum = document.querySelector(".add-album")
let createAlbumSpan = document.querySelector(".create-album")

let likeButton = document.querySelector('.like-button');
let isLiked = document.querySelector('.is-liked');
let albumId = document.querySelector('.album-id').value;
let userId = document.querySelector('.user-id');

if (addAlbum){
    addAlbum.addEventListener('click',function (){
        createAlbumSpan.classList.toggle('hidden');
        console.log("hey2")

    })
}

if(albumSettings){
    let albumId = document.querySelector('.album-id').value;
   albumSettings.addEventListener('click',function (){
        settingsSpan.classList.toggle('hidden');
    })
    publicToggle.addEventListener('change', () => {
        axios.put(window.location.origin + '/api/album/' + albumId + '?isPublic=' + (publicToggle.checked ? 1:0))
            .catch(function (error) {
                console.log(error);
            })
    })
}

if (likeButton) {
    isLiked = isLiked.value == '1';
    console.log(isLiked);
    userId = userId.value;
    likeButton.addEventListener('click', () => {
        isLiked = !isLiked;
        if (isLiked) {
            likeButton.name = 'heart';
            axios.post(window.location.origin + '/api/like?album_id=' + albumId + '&user_id=' + userId)
                .catch(function(error) {
                    console.log(error);
                })
        } else {
            likeButton.name = 'heart-outline';
            axios.delete(window.location.origin + '/api/like?album_id=' + albumId + '&user_id=' + userId)
                .catch(function (error) {
                    console.log(error);
                })
        }
    })
}



