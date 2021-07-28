const bgAvatar = document.querySelector(".field-avatar");
const camera = document.querySelector(".camera");
const fieldAvatar = document.querySelector(".upload-avatar");
const avatar = document.querySelector(".avatar");

bgAvatar.addEventListener("mouseover", function() {
    camera.classList.add("active-upload");
});

bgAvatar.addEventListener("mouseout", function() {
    camera.classList.remove("active-upload");
});

// get urlencode image upload
var encodeAvatar = "";
fieldAvatar.addEventListener("change", function() {
    if (this.files && this.files[0]) {
        if(this.files[0].type != "image/jpeg" && this.files[0].type != "image/jpg" && this.files[0].type != "image/png") {
            alert("Sorry, only JPG, JPEG & PNG files are allowed!");
            return false;
        }
        if(this.files[0].size > 2000000) {
            alert("Sorry, your file is too large!");
            return false;
        }
        var reader = new FileReader();
        reader.addEventListener("load", function (e) {
            avatar.src = e.target.result;
            encodeAvatar = e.target.result;
        });
        reader.readAsDataURL(this.files[0]);
    }
});