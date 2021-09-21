var taskName= document.getElementById("task-name");
var givenDate= document.getElementById("date-given");
var deadline= document.getElementById("date-due");
var numOfQuestions= document.getElementById("number-Of-tasks");
var categoryId= document.getElementById("category");
var unitId= document.getElementById("units-select");

function addTask() {
    let formData= new FormData();
    formData.append("taskName",taskName.value);
    formData.append("givenDate",givenDate.value);
    formData.append("deadline",deadline.value);
    formData.append("numOfQuestions",numOfQuestions.value);
    formData.append("categoryId",categoryId.value);
    formData.append("unitId",unitId.value);
    makeRequest("task/addTask.php",formData,addTaskCallBack);
}
function addTaskCallBack(json) {
    if(json.status != "OK"){
        showError(json.message);
        console.log(json);
        return;
    }
    showSuccess("Task added successfully"); 
    return;
}