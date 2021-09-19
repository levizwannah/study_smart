<?php
 require("master.inc.php");

 if(!$isLoggedIn){
    exit(Response::NLIE());
 }

 $user = new User();
 $user->setId($userId);
 $user->setSessionId($sessionId);
 exit($user->logout());

?>