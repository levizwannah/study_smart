<?php
 require("master.inc.php");

 $dbManager = new DbManager();

 $allUsers = $dbManager->query(Task::TASK_ID, ["DISTINCT ".User::USER_FOREIGN_KEY], "task_status != 'submitted'", [], true, true);

 foreach($allUsers as $userInfo){
     writeEmail($userInfo[User::USER_FOREIGN_KEY]);
 }

 function writeEmail($userId){
    $sub = "Unsubmitted tasks - Study_Smart";
    $user = new User($userId);
    $firstName = $user->getFirstName();

    $msg = "Dear $firstName, <br>You have tasks to submit soon. <br>Regards,<br>Smart_Study team.";

    sendEmail($user->getFirstName() . " ". $user->getLastName(), $user->getEmail(), $sub, $msg);
 }

?>