<?php
 require("master.inc.php");

 $taskId = isset($_POST["task-id"])?(int)$_POST["task-id"]: 
 exit(Response::NIE());
 $status = isset($_POST["task-status"])? abs((int)$_POST["task-status"]): 
 exit(Response::makeResponse("NSE", "please add the new status of the task"));

 $task = new Task($taskId);

 if(!$task->changeStatus($status)){
     exit(Response::UEO());
 }

 exit(Response::OK());

?>