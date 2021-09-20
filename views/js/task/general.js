let category = document.getElementById("category-id");
let taskHolder = document.getElementById("task-holder");

/**
 * builds the html of a task to add it to the list
 * @param {Object} task 
 */
function buildTask(task){
    let html = ``;
    return html;
}

/**
 * 
 * @param {int} status 
 */
function listTasks(status){
    let formData = buildFormData({
        "category-id": category.value,
        "task-status": status
    });

    makeRequest(`task/tasks.php`, formData, listTaskCallback);
}

function listTaskCallback(json){
    if(json.status != "OK"){
        showError(json.message);
    }

    taskHolder.innerHTML = json.message;
}