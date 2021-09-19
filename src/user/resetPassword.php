<?php
require("master.inc.php");

if(!$isLoggedIn){
   exit(Response::NLIE());
}

$oldPassword = isset($_POST["old-password"])?$_POST["old-password"]:"";
$newPassword = isset($_POST["new-password"])?$_POST["new-password"]:"";

$user = new User();
if($user->loadUser($userId)){
    exit($user->changePassword($oldPassword, $newPassword));
}

exit(Response::UEO());

?>