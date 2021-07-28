const like = document.querySelectorAll(".checkbox");
const _token = document.querySelector('input[name="_token"]');
const likeCounter = document.querySelectorAll(".like-counter");
const avatar = document.querySelectorAll(".avatar");
const trash = document.querySelectorAll(".trash");

// ajax for like features
function likeTweets(target, counter) {
    let xhr = new XMLHttpRequest();
    // xhr.responseType = "json";
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            counter.textContent = this.responseText;
        }
    }
    xhr.open("POST", "http://127.0.0.1:8000/tweet/like", true);
    xhr.setRequestHeader("X-CSRF-Token", _token.value);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`tweet_id=${target.id}&status=${target.checked}`);
}

for (let i = 0; i < like.length; i++) {
    like[i].addEventListener("click", function() {
        likeTweets(this, likeCounter[i]);
    });
}

let tooltipElement = document.createElement(`div`);
tooltipElement.setAttribute("class", "active-tooltip text-white");
for (let i = 0; i < avatar.length; i++) {
    avatar[i].addEventListener("mouseover", async function() {
        try {
            let getUser = await userTooltip(avatar[i]);
            tooltipElement.innerHTML = `<div class="media p-2">
                                            <a href="" class="mr-3 avatar-tooltip">
                                                <img class="tooltip-avatar-user align-self-start" src="/storage/${getUser.avatar}" alt="">
                                            </a>
                                            <div class="media d-flex flex-column">
                                                <span class="tooltip-name">${getUser.full_name}</span>
                                                <span class="tooltip-user-name">@${getUser.name}</span>
                                            </div>
                                        </div>
                                        <div class="media-body pl-2 pr-2 pb-2">
                                            <small class="tooltip-following">${getUser.following} Following</small>
                                            <small class="tooltip-follower">${getUser.follower} Followers</small>
                                            <p class="bio-tooltip">${getUser.bio}</p>
                                        </div>`;
            avatar[i].appendChild(tooltipElement);
            return false;
        } catch(e) {
            console.log(e.message);
        }
    });
    avatar[i].addEventListener("mouseout", function() {
        try {
            this.removeChild(tooltipElement);
            return false;
        } catch(e) {
            console.log(e.message);
        }
    });
}

function userTooltip(target) {
    return new Promise(function(resolve, reject) {
        setTimeout(function() {
            let xhr = new XMLHttpRequest();
            xhr.onload = function() {// onload: request finished and response
                if(this.readyState == 4 && this.status == 200) {
                    resolve(JSON.parse(this.response));
                } else {
                    reject(this.status);
                }
            }
            xhr.onerror = function() {
                reject(this.status);
            }
            xhr.open("POST", target.href, true);
            xhr.setRequestHeader("X-CSRF-Token", _token.value);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(`userName=${target.href.match(/\/([^\/]+)\/?$/)[1]}`);
        }, 800);// wait 0.8s to send request
    });
}

for(let i = 0; i < trash.length; i++) {
    trash[i].addEventListener("click", function() {
        const conf = confirm("Do you want delete this tweet?");
        if(conf) {
            deleteTweet(this);
            window.location.reload();
        } else {
            return;
        }
    });
}

function deleteTweet(target) {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    }
    xhr.open("POST", "http://127.0.0.1:8000/tweet/delete", true);
    xhr.setRequestHeader("X-CSRF-Token", _token.value);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(`id=${target.getAttribute("id")}`);
}