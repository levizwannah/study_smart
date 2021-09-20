<?php
 //master is included
 require("master.inc.php");

 $taskId = isset($_POST['taskId'])? $_POST['taskId']:null;
 $taskName = isset($_POST['taskName'])?$_POST['taskName']:null;
 $numOfQuestions = isset($_POST['numOfQuestions'])? $_POST['numOfQuestions']:null;
 $categoryId = isset($_POST['categoryId'])? $_POST['categoryId']:null;
 $unitId = isset($_POST['unitId'])? $_POST['unitId']:null;

 $task = new Task();
 $task->setId($taskId);
 $task->setName($taskName);
 $task->setUnit($unitId);
 $task->setCategory($categoryId);
 $task->setNumOfQuestions($numOfQuestions);
 exit($task->editTask());
?>