let emailCode = document.getElementById("confirmation-code");

function confirmEmail(){
    if(emailCode.value.length < 6){
        showError("Code must be 6 digits long");
        return;
    }

    makeRequest(`user/confirmEmail.php`, buildFormData({"code": emailCode.value}), (json) => {
        if(json.status != "OK"){
            showError(json.message);
            return;
        }

        showSuccess(json.message);
        emailCode.value = "";
        location.href = "edit-profile.php";
    });
}