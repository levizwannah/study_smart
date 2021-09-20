let email= document.getElementById('email');
let password= document.getElementById('password');

function login() {
    let formData= new FormData();
    formData.append(email);
    formData.append(password);
    makeRequest("user/login.php",formData,loginCallBack);
}
function loginCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    showSuccess("successfully Logged In"); // Just for a time being, until we get the UI pages
    localStorage.setItem("user", json.message);
    return;
}
