'use strict'

let albumSettings = document.querySelector(".settings-album")
let settingsSpan=document.querySelector(".settings-span")

albumSettings.addEventListener('click',function (){
    settingsSpan.classList.toggle('hidden');
})
