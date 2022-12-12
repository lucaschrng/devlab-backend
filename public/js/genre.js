/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/genre.js ***!
  \*******************************/
var sort = document.querySelector('.sort-select');
var filter = document.querySelector('.filter-select');
console.log(filter);
filter.addEventListener('change', function () {
  window.location = "../" + filter.value + '/1';
});
/******/ })()
;