var firstname = document.getElementById("firstname"),
    lastname = document.getElementById("lastname"),
    profileImage = document.getElementById("profile-image"),
    profileImageInput = document.getElementById("profile-image-input"),
    uploadButton = document.getElementById("upload-image-btn"),

    oldPassword = document.getElementById("old-password"),
    newPassword = document.getElementById("new-password");

uploadButton.addEventListener("click", function(){
    profileImageInput.click();
});

function uploadImage(){
    if(!profileImageInput.files[0]){
        showError("No Image Selected");
        return;
    }

    let formData = new FormData();
    let formData = buildFormData({
        "profile-image": profileImageInput.files[0]
    });
    makeRequest("user/editProfile.php", formData, loadImage);
}

function loadImage(response){
    if(response.status != "OK"){
        showError(response.message);
        return;
    }

    let link = JSON.parse(response.message).profileImage;
    profileImage.src =  getFullStorageLink(link);

    let user = localStorage.getItem("user");
    user.profileImage = link;

    window.localStorage.setItem("user", JSON.stringify(user));
    return;
}

function updateProfile(){
    let formData = buildFormData({
        "first-name": firstname.value,
        "last-name": lastname.value,
        "email": email.value
    });
    makeRequest("user/editProfile.php", formData, updateUser);
}

function updateUser(json){
    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    showSuccess("successfully updated your profile");
    localStorage.setItem("user", json.message);

    return;
}

function resetPassword(){
    let formData = buildFormData({
        "old-password": oldPassword.value,
        "new-password": newPassword.value
    });
    
    makeRequest("user/resetPassword.php", formData, (response) => {
        if(response.status != "OK"){
            showError(response.message);
            return;
        }

        showSuccess(response.message);
    });
}