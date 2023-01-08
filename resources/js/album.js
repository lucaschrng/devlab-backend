'use strict'

const axios = require('axios');

let albumSettings = document.querySelector(".settings-album")
let settingsSpan=document.querySelector(".settings-span")
let publicToggle = document.querySelector("#toggle-example");

let addAlbum = document.querySelector(".add-album")
let createAlbumSpan = document.querySelector(".create-album")

let likeButton = document.querySelector('.like-button');
let isLiked = document.querySelector('.is-liked');
let userId = document.querySelector('.user-id');
let likes = document.querySelector('.likes');

if (addAlbum){
    addAlbum.addEventListener('click',function (){
        createAlbumSpan.classList.toggle('hidden');
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
    let albumId = document.querySelector('.album-id').value;
    isLiked = isLiked.value == '1';
    let likesCount = parseInt(likes.innerHTML);
    userId = userId.value;
    likeButton.addEventListener('click', () => {
        isLiked = !isLiked;
        if (isLiked) {
            likeButton.name = 'heart';
            likesCount++;
            likes.innerHTML = likesCount;
            axios.post(window.location.origin + '/api/like?album_id=' + albumId + '&user_id=' + userId)
                .catch(function(error) {
                    console.log(error);
                })
        } else {
            likeButton.name = 'heart-outline';
            likesCount--;
            likes.innerHTML = likesCount;
            axios.delete(window.location.origin + '/api/like?album_id=' + albumId + '&user_id=' + userId)
                .catch(function (error) {
                    console.log(error);
                })
        }
    })
}



