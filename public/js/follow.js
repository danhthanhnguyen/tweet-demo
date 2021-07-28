const follow = document.querySelector(".follow");

// ajax for follow features
if(follow) {
    follow.addEventListener("click", function() {
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                follow.textContent = this.responseText;
            }
        }
        xhr.open("POST", `http://127.0.0.1:8000/${follow.getAttribute("aria-label")}/follow`, true);
        xhr.setRequestHeader("X-CSRF-Token", _token.value);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(`user=${follow.getAttribute("aria-label")}`);
    });
}