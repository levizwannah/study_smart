<?php

    require("master.inc.php");

    $dbManager = new DbManager();

    //this will be inefficient for now
    //This is your code... code reuse...
    $allUnitsIds = $dbManager->query(Unit::UNIT_TABLE, [Unit::UNIT_ID, "unit_name"],  User::USER_FOREIGN_KEY. " = ? ", [$userId], true, true);

    if($allUnitsIds === false){
        exit(Response::SQE());
    }

    $unitsHtml = "";
    foreach($allUnitsIds as $unitIdInfo){
        $unitName = $unitIdInfo["unit_name"];
        $unitId = $unitIdInfo[Unit::UNIT_ID];
        $unitsHtml .= "
            <option value='$unitId'>$unitName</option>
            ";
    }

    exit(Response::makeResponse("OK", $unitsHtml));
?>