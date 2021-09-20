var addButton = document.getElementById("add-unit-btn");

addButton.addEventListener("click", function(){
    auFormSubBtn = auFormSubBtn.cloneNode(true);
    auFormSubBtn.innerHTML = "Add";
    
    auFormSubBtn.onclick = addUnit();
    showAUForm();
});
/**
 * Adds a new unit
 * @param {string} unitName 
 */

function addUnit(){
    let unitName = unitNameInput.value;
    let formData = buildFormData({"unit-name": unitName});
    
    hideAUForm();
    makeRequest(`unit/add.php`, formData, displayUnit);
}

function displayUnit(json){
    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    let unit = JSON.parse(json.message);
    showSuccess(unit.message);
    document.getElementById("unit-holder").appendChild(buildUnit(unit));
}
