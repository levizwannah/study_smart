
/**
 * Deletes a unit
 * @param {int} unitId 
 */

function deleteUnit(unitId){
    if(!confirm("Do you really want to remove this")) return;
    
    let formData = buildFormData({"unit-id": unitId});
    makeRequest(`unit/delete.php`, formData, (json) => {
        removeUnit(unitId, json);
    });
}

/**
 * Removes a unit from the list if successfully deleted
 * @param {int} unitId 
 * @param {Object} json 
 */
function removeUnit(unitId, json){
    if(json.status != "OK"){
        showError(json.message);
        return;
    }

    showSuccess(json.message);
    document.getElementById(`unit-${unitId}`).remove();
    return;
}