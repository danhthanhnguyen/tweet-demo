// scroll to top variables
const scrollUp = document.querySelector(".up-arrow");

// scroll to top
window.addEventListener("scroll", function() {
    if (Math.floor(window.pageYOffset) > 50) {
        scrollUp.classList.add("scroll-up");
    } else {
        scrollUp.classList.remove("scroll-up");
    }
})
scrollUp.addEventListener("click", function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
})
