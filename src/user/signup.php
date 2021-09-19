<?php
    require("master.inc.php");
    if($isLoggedIn){
        exit(Response::ALIE());
    }


    //e = email test and s = signup
    $action = isset($_POST['action'])?$_POST['action']:"s";
    $email = isset($_POST['email'])?$_POST['email']:null;
    $firstname = 
    $newUser = new User();
    $newUser->setEmail($email);

    switch($action){
        case "e":
            {
                $dbManager = new DbManager();
                if(User::doesEmailExist($email, $dbManager)){
                    exit(Response::EEE());
                }
                exit(Response::OK());
            }
        case "s":
            {
                $password = isset($_POST['password'])? $_POST['password']:null;
                $newUser->setPassword($password);
                exit($newUser->register());
            }
        default:
        {
            exit(Response::UEO());
        }
    }
?>