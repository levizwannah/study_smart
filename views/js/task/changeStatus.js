
function submit(taskId, numberOfQuestions){
    let task = document.querySelector(`#task-${taskId}`);

    let checkboxes = task.querySelectorAll(`input[type=checkbox]`);
    let totalChecked = [].filter.call(checkboxes, function (ch){
        return ch.checked;
    });

    if(totalChecked.length == numberOfQuestions){
      changeTaskStatus(taskId, 3, totalChecked.length);   
    }
    return;
}
/**
 * 
 * @param {int} taskId - task id 
 * @param {int} newStatus - new status index in the statuses array
 * `[not_started, doing, done, submitted]` 
 */
function changeTaskStatus(taskId, newStatus, numDone, shouldmove = true){
    if(taskId < 1 || newStatus < 0){
        return;
    }
    let formData = buildFormData({
        "task-id": taskId,
        "task-status": newStatus,
        "num-done": numDone
    });

    makeRequest(`task/changeStatus.php`, formData, 
    (json) => {removeTask(taskId, json, shouldmove)});
}

function removeTask(taskId, json, shouldmove){

    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    showSuccess(json.message);
    if(!shouldmove){
      return;
    }
    let task = document.getElementById(`task-${taskId}`);
    task.style.opacity = "0";
    task.addEventListener("transitionend", function(){
        this.remove();
    });
}

/**
 * Task id to submit
 * @param {int} taskId 
 */
function submitTask(taskId){
    changeTaskStatus(taskId, 3);
}

