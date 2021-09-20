<?php
 require("master.inc.php");
 $taskId = isset($_POST['taskId'])? $_POST['taskId']: exit(Response::NIE());
 $task = new Task($taskId);
 exit($task->getProgressStatus());
?>