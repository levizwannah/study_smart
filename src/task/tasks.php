<?php

    require("master.inc.php");

    $categoryId = isset($_POST["category-id"])? (int)$_POST["category-id"]: 1;

    $status = isset($_POST["task-status"])? abs((int)$_POST["task-status"]): Task::STATUS_NOT_STARTED;

    $dbManager = new DbManager();

    //this will be inefficient for now

    $allTasksIds = $dbManager->query(Task::TASK_TABLE, [Task::TASK_ID],  "task_status = ? and ". User::USER_FOREIGN_KEY. " = ? and ". Category::CAT_FOREIGN_KEY . " = ?", [Task::TASK_STATUSES[$status], $userId, $categoryId], true, true);

    if($allTasksIds === false){
        exit(Response::SQE());
    }

    $tasksHtml = "";
    foreach($allTasksIds as $taskIdInfo){
        $task = new Task($taskIdInfo[Task::TASK_ID]);
        
    }

    exit(Response::makeResponse("OK", $tasksHtml));
?>