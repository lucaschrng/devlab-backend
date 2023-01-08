/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/album.js ***!
  \*******************************/


var albumSettings = document.querySelector(".settings-album");
var settingsSpan = document.querySelector(".settings-span");
var addAlbum = document.querySelector(".add-album");
var createAlbumSpan = document.querySelector(".create-album");
console.log(addAlbum);
if (addAlbum) {
  addAlbum.addEventListener('click', function () {
    createAlbumSpan.classList.toggle('hidden');
    console.log("hey2");
  });
}
if (albumSettings) {
  albumSettings.addEventListener('click', function () {
    settingsSpan.classList.toggle('hidden');
  });
}
/******/ })()
;