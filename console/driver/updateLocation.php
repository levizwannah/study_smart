<?php

    require("master.inc.php");

    //updates the driver locations
    $fbManager = new FirebaseManager();
    
    $driverTable = Driver::DRIVER_TABLE;
    $driverLocTable = Driver::DRIVER_LOC_TABLE;
    $driverTableId = Driver::DRIVER_ID;
    $driverLocId = Driver::DRIVER_LOC_ID;


    $sqlForQuery = "SELECT $driverLocTable.* from $driverLocTable inner join $driverTable on $driverTableId = $driverLocId where online_status > 0";

    $sqlForStatus = "UPDATE $driverTable set online_status = false where $driverTableId = ?";

    $updateSql = "UPDATE $driverLocTable set c_lat = ? , c_long = ?, updated_on = ? where $driverLocId = ?";

    $dbManager = new DbManager();
    $conn = $dbManager->getDbConnection();

    $stmt1 = $conn->prepare($sqlForQuery);
    $stmt2 = $conn->prepare($sqlForStatus);
    $stmt3 = $conn->prepare($updateSql);
   
    while(true){
        
        if(!$stmt1->execute()){
            echo " An error occurred \n";
            sleep(10);
            continue;
        }
        
        $allDriversInfo = $stmt1->fetchAll();

        if(count($allDriversInfo) < 1){
            echo " No Drivers to update \n";
            sleep(60);
            continue;
        }

        foreach($allDriversInfo as $driverInfo){
            $fbInfo = $fbManager->ref("drivers/did-".$driverInfo["driverId"]."/cLocation")->getValue();

            $latitude = $fbInfo["latitude"];
            $longitude = $fbInfo["longitude"];
            $updatedAt = $fbInfo["updatedAt"];

            $lastUpdated = ($updatedAt/1000) - strtotime($driverInfo["updated_on"]);
            echo $driverInfo['driverId']." last updated on $lastUpdated";

            //ten minutes offline changes your status to offline
            if($lastUpdated > 600000){
                $stmt2->execute([$driverInfo["driverId"]]);
                continue;
            }

            $date = date("Y-m-d H:i:s", ($updatedAt/1000));
            $stmt3->execute([$latitude, $longitude, $date]);
        }

        echo "Next check after 5 seconds";
        sleep(10);
    }

?>