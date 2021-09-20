<?php
    require("master.inc.php");

    $unitId = isset($_POST["unit-id"])? (int)$_POST['unit-id']: 
    exit(Response::NIE());

    $unitName = isset($_POST["unit-name"])? filter_var($_POST["unit-name"], FILTER_SANITIZE_STRING): exit(Response::UNE());

    $newUnit = new Unit($unitId);
    $newUnit->setName($unitName);

    if(!$newUnit->update()){
        exit(Response::SQE());
    }

    exit(Response::makeResponse(
        "OK",
        json_encode([
            "unitId" => $newUnit->getId(),
            "unitName" => $newUnit->getName(),
            "message" => "Successfully updated the unit"
        ])
        ));



?>