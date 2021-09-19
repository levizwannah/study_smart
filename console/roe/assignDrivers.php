<?php
    require("master.inc.php");

    print_r($argv);
   
    $token = $argv[1];
    $id = $argv[2];
    $sLat = $argv[3];
    $sLong = $argv[4];
    $eLat = $argv[5];
    $eLong = $argv[6];

    $rideAssigner = new RideAssigner($sLat, $sLong);

    
?>