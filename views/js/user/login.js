let email= document.getElementById('email');
let password= document.getElementById('password');

function login() {
    let formData= new FormData();
    formData.append(email);
    formData.append(password);
    
    makeRequest("login.php",formData,loginCallBack);
}
function loginCallBack() {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    
    showSuccess("successfully updated your profile");
    localStorage.setItem("user", json.message);
    return;
}
