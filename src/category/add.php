<?php
    require("master.inc.php");

    $categoryName = isset($_POST["category-name"])? filter_var($_POST["category-name"], FILTER_SANITIZE_STRING): exit(Response::UNE());

    if(empty($categoryName)){
        exit(Response::UNE());
    }

    $newCategory = new Category();

    $newCategory->setName($categoryName);

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
            "unitId" => $unitId,
            "unitName" => $newUnit->getName(),
            "message" => "Successfully added the unit"
        ])
        ));



?>