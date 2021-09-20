<?php
    require("master.inc.php");

    $unitName = isset($_POST["unit-name"])? filter_var($_POST["unit-name"], FILTER_SANITIZE_STRING): exit(Response::UNE());

    $newUnit = new Unit();

    $newUnit->setName($unitName);
    $newUnit->setUserId($userId);

    if($newUnit->exists()){
        exit(Response::makeResponse("UAEE", "The unit already exist"));
    }

    $unitId = $newUnit->add();

    if($unitId == -1){
        exit(Response::SQE());
    }

    exit(Response::makeResponse(
        "OK",
        json_encode([
            "unitId" => $newUnit->getId(),
            "unitName" => $newUnit->getName(),
            "message" => "Successfully added the unit"
        ])
        ));



?>