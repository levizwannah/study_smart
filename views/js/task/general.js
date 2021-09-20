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

/**
 * Lists the cards
 * @param {Object} json 
 */
function listTaskCallback(json){
    if(json.status != "OK"){
        showError(json.message);
    }

    taskHolder.innerHTML = json.message;
    
    //updating the percentages to appear on the ui
    let allTasks = taskHolder.children;
    for(i = 0; i < allTasks.length; i++){
        let task = allTasks[i];
        let actuatId = task.id.split("-");
        let tQuestions = task.querySelector(`#total-questions-t-${actuatId}`);
        let tCompleted = task.querySelector(`#total-completed-t-${actuatId}`);
        let ratio = Number(tCompleted)/Number(tQuestions);
        let percentage = ratio * 100;
        let percentText = `${percentage}%`;

        let pRHolder = task.querySelector(`#p-range-h-t-${actuatId}`);
        let maxWidth = pRHolder.parentElement.clientWidth;

        pRHolder.style.width = `${Math.ceil(ratio * maxWidth)}px`;
        task.querySelector(`#percent-t-${actuatId}`).innerHTML = percentText;

        let checkboxes = task.querySelectorAll(`input[type=checkbox]`);
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function(){
                let totalChecked = [].filter.call(checkboxes, function (ch){
                    return ch.checked;
                });

                if(totalChecked.length == checkboxes.length && category.value != 2){
                    changeTaskStatus(actuatId, 2);
                }
                else if(totalChecked.length == 0 && category.value != 0){
                    changeTaskStatus(actuatId, 0);
                }
                else if(totalChecked.length < checkboxes.length && category.value != 1){
                    changeTaskStatus(actuatId, 1);
                }
            });
        });
    }
}

