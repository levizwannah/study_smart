let taskName= document.getElementById("taskName");
let deadline= document.getElementById("deadline");
let numOfQuestions= document.getElementById("numOfQuestions");
let categoryId= document.getElementById("categoryId");
let unitId= document.getElementById("unitId");

function addTask() {
    let formData= new FormData();
    formData.append("taskName",taskName);
    formData.append("deadline",deadline);
    formData.append("numOfQuestions",numOfQuestions);
    formData.append("categoryId",categoryId);
    formData.append("unitId",unitId);
    makeRequest("task/addTask.php",formData,addTaskCallBack);
}
function addTaskCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    showSuccess("Task added successfully"); 
    return;
}