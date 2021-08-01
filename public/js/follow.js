/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/follow.js ***!
  \********************************/
var follow = document.querySelector(".follow"); // ajax for follow features

if (follow) {
  follow.addEventListener("click", function () {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        follow.textContent = this.responseText;
      }
    };

    xhr.open("POST", "http://127.0.0.1:8000/".concat(follow.getAttribute("aria-label"), "/follow"), true);
    xhr.setRequestHeader("X-CSRF-Token", _token.value);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("user=".concat(follow.getAttribute("aria-label")));
  });
}
/******/ })()
;