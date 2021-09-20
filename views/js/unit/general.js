var aUForm = document.getElementById("add-unit-form");
var unitNameInput = document.getElementById("unit-name-input");
var auFormSubBtn = document.getElementById("unit-form-submit-btn");
var unitPlusBtn = document.getElementById("unit-plus-btn");
var unitListHolder = document.getElementById("units-holder");

/**
 * Show add unit form
 */
function showAUForm(){
    unitPlusBtn.style.display = "none";
    aUForm.style.display = "";
}

/**
 * hide add unit form
 */
function hideAUForm(){
    unitPlusBtn.style.display = "";
    aUForm.style.display = "none";
    unitNameInput.value = "";
}

/**
 * builds and html for a unit to add to the list
 * @param {Object} unit 
 */
 function buildUnit(unit){
    let html = ` <div class="flex flex-row items-center justify-between p-2 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl border-gray-100 border-2 p-6 hover:shadow-2xl">
    <div class="flex-3 justify-self-start">
        <div class="text-gray-600 text-sm">
            ${unit.unitName}
        </div>
    </div>
    <div class="flex justify-between items-center w-1/4">
        <i class="far fa-edit text-blue-500 block" onclick="updateUnit(${unit.unitId})"></i>
        <i class="fas fa-trash-alt text-red-500 block" onclick="deleteUnit(${unit.unitId})"></i>
    </div>
  
</div>  `;

    return html;
}

function listUnits(){
    makeRequest(`unit/units.php`, new FormData(), (json) =>{
        if(json.status != "OK"){
            showError(json.message);
            return;
        }

        unitListHolder.innerHTML = json.message;
        return;
    });
}

//listing units
listUnits();

