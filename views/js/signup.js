let firstname = document.getElementById("firstname"),
    lastname = document.getElementById("lastname"),
    email = document.getElementById("email"),
    password = document.getElementById("password"),
    confirmPassword = document.getElementById("c-password");


function register(){
    if(password.value != confirmPassword.value){
        showError("Passwords do not match");
    }
    let formData = new FormData();
    formData.append("firstname", firstname.value);
    formData.append("lastname", lastname.value);
    formData.append("email", email.value);
    formData.append("password", password.value);

    makeRequest("signup.php", formData, checkResult);
}