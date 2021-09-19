let firstname = document.getElementById("firstname"),
    lastname = document.getElementById("lastname"),
    email = document.getElementById("email"),
    password = document.getElementById("password"),
    confirmPassword = document.getElementById("c-password");


function register(){
    if(password.value != confirmPassword.value){
        showError("Passwords do not match");
    }

    makeRequest("")
}