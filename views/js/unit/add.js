

unitPlusBtn.addEventListener("click", (e)=>{
    auFormSubBtn.innerHTML = "Add";
    console.log(`I am in here`);
    auFormSubBtn.setAttribute("onclick", "addUnit()");
    //auFormSubBtn.onclick = addUnit();
    console.log(auFormSubBtn);
    showAUForm();
    
});

/**
 * Adds a new unit
 * @param {string} unitName 
 */
function addUnit(){
    console.log(`Here I am`);
    
    let unitName = unitNameInput.value;
    let formData = buildFormData({"unit-name": unitName});
    
    makeRequest(`unit/add.php`, formData, displayUnit);
}

function displayUnit(json){
    console.log(json);
    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    let unit = JSON.parse(json.message);
    showSuccess(unit.message);
    hideAUForm();
    unitListHolder.innerHTML += buildUnit(unit);
}
