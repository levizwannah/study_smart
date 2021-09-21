let category = document.getElementById("category-id");
let taskHolder = document.getElementById("task-holder");
let taskStatus = document.getElementById("task-status");
let statusDiv = document.getElementById("select-status");
let unitsList = document.getElementById("units-select");

setActiveNav(document.getElementById(`c-${category.value}`));

const colorsClasses = ["bg-red-200", "bg-yellow-200", "bg-blue-200", "bg-green-200"];

function changeStatusColor(){
    let pStatus = localStorage.getItem("cStatus");
    if(pStatus){
        statusDiv.classList.remove(colorsClasses[Number(pStatus)]);
    }

    statusDiv.classList.add(colorsClasses[taskStatus.value]);
    localStorage.setItem("cStatus", `${taskStatus.value}`);
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

/**
 * Lists the units
 */
function listUnits() {
    makeRequest(`task/units.php`, new FormData(), (json) =>{
        if(json.status != "OK"){
            showError(json.message);
            return;
        }

        unitListHolder.innerHTML = json.message;
        return;
    });
}


