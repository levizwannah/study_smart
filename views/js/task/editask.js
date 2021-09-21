    taskName = document.getElementById("taskName");
    numOfQuestions= document.getElementById("numOfQuestions");
    categoryId= document.getElementById("categoryId");
    unitId= document.getElementById("unitId");
    userId= document.getElementById("userId");
    taskId= document.getElementById("taskId");//hypothesis

function editTask() {
    let formData= new FormData();
    formData.append("taskId",taskId);
    formData.append("taskName",taskName);
    formData.append("numOfQuestions",numOfQuestions);
    formData.append("categoryId",categoryId);
    formData.append("unitId",unitId);
    makeRequest("task/editTask.php",formData,editTaskCallBack);
}
function editTaskCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    showSuccess("Task edited successfully"); 
    return;
}