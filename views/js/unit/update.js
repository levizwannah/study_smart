

function updateUnit(unitId){
    let unitName = document.getElementById(`unit-${unitId}`).querySelector('#name').innerHTML;
    unitNameInput.value = unitName;
    showAUForm();
    auFormSubBtn.innerHTML = "update";

    auFormSubBtn.onclick = function(){
        let formData = buildFormData({
            "unit-name": unitNameInput.value,
            "unit-id": unitId
        });

        makeRequest(`unit/update.php`, formData, (json) => 
         {showUpdatedUnit(unitId, json)});

        
    }
}


function showUpdatedUnit(unitId, json){
    if(json.status != "OK"){
        showError(json.message);
        return;
    }
    
    hideAUForm();
    let unit = JSON.parse(json.message);
    showSuccess(unit.message);
    document.getElementById(`unit-${unitId}`).querySelector("#name").innerHTML = unit.unitName;
}

