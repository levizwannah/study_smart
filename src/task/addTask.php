<?php
 //master is included
 require("master.inc.php");

 $taskName = isset($_POST['taskName'])?$_POST['taskName']:null;
 $deadline = isset($_POST['deadline'])? $_POST['deadline']:null;
 $numOfQuestions = isset($_POST['numOfQuestions'])? $_POST['numOfQuestions']:null;
 $categoryId = isset($_POST['categoryId'])? $_POST['categoryId']:null;
 $unitId = isset($_POST['unitId'])? $_POST['unitId']:null;
 $userId = isset($_POST['userId'])? $_POST['userId']:null;

 $task = new Task();
 $task->setUserId($userId);
 $task->setName($taskName);
 $task->setUnit($unitId);
 $task->setCategory($categoryId);
 $task->setNumOfQuestions($numOfQuestions);
 $task->setDeadline($deadline);
 exit($task->addTask());
?>