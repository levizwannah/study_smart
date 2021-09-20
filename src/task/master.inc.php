<?php
     require(__DIR__."/../master.inc.php");

     if(!$isLoggedIn){
        exit(Response::NLIE());
     }

?>