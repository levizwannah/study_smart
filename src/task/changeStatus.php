<?php
 require("master.inc.php");

 $taskId = isset($_POST["task-id"])?(int)$_POST["task-id"]: 
 exit(Response::NIE());
 $status = isset($_POST["task-status"])? abs((int)$_POST["task-status"]): 
 exit(Response::makeResponse("NSE", "please add the new status of the task"));

 $numDone = isset($_POST["num-done"])? abs((int)$_POST["num-done"]): 
 exit(Response::makeResponse("NQDE", "please check the number of questions done the task using the check box"));

 $task = new Task($taskId);
 $task->setQuestionsDone($numDone);

 if(!$task->changeStatus($status)){

     exit(Response::UEO());
 }

 if($status != Task::STATUS_DONE){
    exit(Response::OK());
 }

 exit(Response::makeResponse("OK", 
 "You have completed the task. Please take a break before proceeding to complete the next dued tasked"));
 //notify of 30 mins break here.


?>