let taskId= document.getElementById("taskId");//hypothesis
function editTask() {
    let formData= new FormData();
    formData.append("taskId",taskId);
    makeRequest("task/getProgressStatus.php",formData,progressStatusCallBack);
}

function progressStatusCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    return json.message;
}