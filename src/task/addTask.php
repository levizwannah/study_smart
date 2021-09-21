<?php
 //master is included
 require("master.inc.php");

 $taskName = isset($_POST['taskName'])?$_POST['taskName']:null;
 $deadline = isset($_POST['deadline'])? $_POST['deadline']:null;
 $numOfQuestions = isset($_POST['numOfQuestions'])? $_POST['numOfQuestions']:null;
 $categoryId = isset($_POST['categoryId'])? $_POST['categoryId']:null;
 $unitId = isset($_POST['unitId'])? $_POST['unitId']:null;
 $givenDate = isset($_POST['givenDate'])? $_POST['givenDate']:null;
 $userId = isset($_POST['userId'])? $_POST['userId']:null;

 $task = new Task();
 $task->setUserId($userId);
 $task->setName($taskName);
 $task->setUnit($unitId);
 $task->setCategory($categoryId);
 $task->setNumOfQuestions($numOfQuestions);
 $task->setDeadline($deadline);
 $rowId= $task->addTask();
 
 if($rowId == -1){
    return Response::SQE();
  }
  exit(Response
  ::makeResponse(
    "OK",
    json_encode([
        "name" => $task->getName(),
        "deadline" => $task->getDeadline(),
        "numOfQuestions" => $task->getNumOfQuestions(),
        "category" => $task->getCategory(),
        "unit_id" => $task->getUnit(),
        "user_id" => $task->getUserId(),
        "message" => "Successfully added the task"
    ])
    ));
 
?>