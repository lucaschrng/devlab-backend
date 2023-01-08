'use strict'

let albumSettings = document.querySelector(".settings-album")
let settingsSpan=document.querySelector(".settings-span")

let addAlbum = document.querySelector(".add-album")
let createAlbumSpan = document.querySelector(".create-album")


console.log(addAlbum);

if (addAlbum){
    addAlbum.addEventListener('click',function (){
        createAlbumSpan.classList.toggle('hidden');
        console.log("hey2")

    })
}



if(albumSettings){
   albumSettings.addEventListener('click',function (){
        settingsSpan.classList.toggle('hidden');
    })
}




