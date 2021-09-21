let category = document.getElementById("category-id");
let taskHolder = document.getElementById("tasks-holder");
let taskStatus = document.getElementById("task-status");
let statusDiv = document.getElementById("select-status");
let unitsList = document.getElementById("units-select");
let showList = document.getElementById("show-units-list");
let selectedUnitName = document.getElementById("selected-unit-name");
let showAddTaskFormBtn;
let selectedUnitId = 0;


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
function listTasks(){
    if(selectedUnitId == 0){
        return;
    }

    let formData = buildFormData({
        "category-id": category.value,
        "task-status": taskStatus.value,
        "unit-id": selectedUnitId
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
    
    showAddTaskFormBtn = document.getElementById('show-add-task-form');
    showAddTaskFormBtn.onclick = ()=>{
        location.href = "task-form.php";
    }

    //updating the percentages to appear on the ui
    let allTasks = taskHolder.children;
    if(allTasks.length == 1) return; //only the plus sign is on the screen

    for(i = 0; i < (allTasks.length - 1); i++){
        let task = allTasks[i];
        let actuatId = task.id.split("-")[1];
        let tQuestions = task.querySelector(`#total-questions-t-${actuatId}`);
        let tCompleted = task.querySelector(`#total-completed-t-${actuatId}`);
        let ratio = Number(tCompleted.value)/Number(tQuestions.value);
        let percentage = ratio * 100;
        let percentText = `${percentage}%`;

        let pRHolder = task.querySelector(`#p-range-h-t-${actuatId}`);
        let maxWidth = pRHolder.parentElement.clientWidth;

        pRHolder.style.width = `${Math.ceil(ratio * maxWidth)}px`;
        let percentHtml = task.querySelector(`#percent-t-${actuatId}`);
        percentHtml.innerHTML = percentText;

        let checkboxes = task.querySelectorAll(`input[type=checkbox]`);
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', function(){
                let totalChecked = [].filter.call(checkboxes, function (ch){
                    return ch.checked;
                });

                ratio = Number(totalChecked.length)/Number(tQuestions.value);
                percentage = ratio * 100;
                let percentText = `${percentage}%`;

                percentHtml.innerHTML = percentText;
                pRHolder.style.width = `${Math.ceil(ratio * maxWidth)}px`;

                if(totalChecked.length == checkboxes.length && taskStatus.value != 2){
                    changeTaskStatus(actuatId, 2, totalChecked.length);
                }
                else if(totalChecked.length == 0 && taskStatus.value != 0){
                    changeTaskStatus(actuatId, 0, totalChecked.length);
                }
                else if(totalChecked.length < checkboxes.length && taskStatus.value != 1){
                    changeTaskStatus(actuatId, 1, totalChecked.length);
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

/**
 * This function populates any select list for the units
 * @param {HTMLElement} unitSelectElement 
 * @param {int} value 
 */
async function populateUnitsList(unitSelectElement = unitsList, value = null){
    const json = await makeRequest(`task/units.php`, buildFormData({}));

    if(json.status != "OK"){
        showError(json.message);
        return false;
    }

    unitSelectElement.innerHTML = json.message;
    if(value){
        unitSelectElement.value = value;
        selectedUnitId = value;
    }

    return true;
}

//populate the list
populateUnitsList(unitsList, localStorage.getItem("selectedUnit")).then((boolean) => {
    if(!boolean){
        showError("Cold not list your tasks, an error occurred");
        return;
    }

    //check if the person has added a unit
    if(unitsList.children.length < 1){
        showError("You haven't added any unit yet. please do so");
        setTimeout(() => {
            location.href = "units.php";
        }, 3000);
    }
    selectedUnitName.innerHTML = unitsList.options[unitsList.options.selectedIndex].innerHTML;
    listTasks();
});

//setting the units list on selected listener
unitsList.addEventListener("change", function(){
    localStorage.setItem("selectedUnit", `${unitsList.value}`);
    selectedUnitId = unitsList.value;

    selectedUnitName.innerHTML = unitsList.options[unitsList.options.selectedIndex].innerHTML;
    listTasks();
    showList.click();
});

//

//listening for task change
taskStatus.addEventListener("change", function(){
    changeStatusColor();
    listTasks();
});

//show the list
showList.addEventListener("click", function(){
    console.log("showing units list");

    if(unitsList.parentElement.style.display == "none"){
        unitsList.parentElement.style.display = "";
        return;
    }

    unitsList.parentElement.style.display = "none";
});




