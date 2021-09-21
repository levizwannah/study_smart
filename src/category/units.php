<?php

    require("master.inc.php");

    $dbManager = new DbManager();

    //this will be inefficient for now

    $allUnitsIds = $dbManager->query(Unit::UNIT_TABLE, [Unit::UNIT_ID, "unit_name"],  User::USER_FOREIGN_KEY. " = ? ", [$userId], true, true);

    if($allUnitsIds === false){
        exit(Response::SQE());
    }

    $unitsHtml = "";
    foreach($allUnitsIds as $unitIdInfo){
        $unitName = $unitIdInfo["unit_name"];
        $unitId = $unitIdInfo[Unit::UNIT_ID];

        $unitsHtml .= " <div id='unit-$unitId' class='flex flex-row items-center justify-between mt-2 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl border-gray-100 border-2 p-6 hover:shadow-2xl'>
        <div class='flex-3 justify-self-start'>
            <div id='name' class='text-gray-600 text-sm'>$unitName</div>
        </div>
        <div class='flex justify-between items-center w-1/4'>
            <i class='far fa-edit text-blue-500 block' onclick = 'updateUnit($unitId)'></i>
            <i class='fas fa-trash-alt text-red-500 block' onclick = 'deleteUnit($unitId)'></i>
        </div>
    </div>";
    }

    exit(Response::makeResponse("OK", $unitsHtml));
?>