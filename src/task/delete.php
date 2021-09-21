<?php
 require("master.inc.php");
 $taskId = isset($_POST['task-id'])? $_POST['task-id']: exit(Response::NIE());

 $task = new Task($taskId);

 if(!$task->delete()){
     exit(Response::SQE());
 }

 exit(Response::OK());
 
?>