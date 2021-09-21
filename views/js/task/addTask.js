let taskName= document.getElementById("taskName");
let givendate= document.getElementById("givendate");
let deadline= document.getElementById("deadline");
let numOfQuestions= document.getElementById("numOfQuestions");
let categoryId= document.getElementById("categoryId");
let unitId= document.getElementById("unitId");
let userId= document.getElementById("unitId");

function addTask() {
    let formData= new FormData();
    formData.append("userId",userId);
    formData.append("taskName",taskName);
    formData.append("givenDate",givenDate);
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