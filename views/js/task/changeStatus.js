/**
 * 
 * @param {int} taskId - task id 
 * @param {int} newStatus - new status index in the statuses array
 * `[not_started, doing, done, submitted]` 
 */
function changeTaskStatus(taskId, newStatus){
    if(taskId < 1 || newStatus < 1){
        return;
    }
    let formData = buildFormData({
        "task-id": taskId,
        "task-status": newStatus
    });

    makeRequest(`task/changeStatus.php`, formData, 
    (json) => {removeTask(taskId, json)});
}

function removeTask(taskId, json){

    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    showSuccess("Task moved successfully");
    let task = document.getElementById(`task-${taskId}`);
    task.style.opacity = "0";
    task.addEventListener("transitionend", function(){
        this.parentElement.remove();
    });
}

