<?php
 require("master.inc.php");

 if($isLoggedIn){
    exit(Response::ALIE());
 }

 $email = isset($_POST['email'])?$_POST['email']:null;
 $password = isset($_POST['password'])? $_POST['password']:null;

 $user = new User();
 $user->setEmail($email);
 $user->setPassword($password);
 exit($user->login());

?>