<?php
 require("master.inc.php");
 $taskId = isset($_POST['taskId'])? $_POST['taskId']:null;
 $task = new Task($taskId);
 exit($task->getProgressStatus());
?>