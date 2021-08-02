/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/follow.js ***!
  \********************************/
var follow = document.querySelector(".follow");

var _token = document.querySelector('input[name="_token"]'); // ajax for follow features


if (follow) {
  follow.addEventListener("click", function () {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        follow.textContent = this.responseText;
      }
    };

    xhr.open("POST", "/".concat(follow.getAttribute("aria-label"), "/follow"), true);
    xhr.setRequestHeader("X-CSRF-Token", _token.value);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("user=".concat(follow.getAttribute("aria-label")));
  });
}
/******/ })()
;