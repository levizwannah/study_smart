<?php
    require("master.inc.php");

    $dbManager = new DbManager();
    $fbManager = new FirebaseManager();


    $sql = "SELECT distinct groupId from ". Ride::RIDE_TABLE. " where completed = 0 ";

    $conn = $dbManager->getDbConnection();

    $stmt = $conn->prepare($sql);

    while(true){
       if(!$stmt->execute()){
          echo "An error occurred ";
       };

       $allGroupIds = $stmt->fetchAll();

       foreach($allGroupIds as $groupInfo){
           $groupId = $groupInfo["groupId"];
            $groupUrl = "groups/gid-$groupId/timer";
            $currentTime = $fbManager->ref($groupUrl)->getValue();
            if($currentTime <= 0){
             continue;
            }
            $currentTime -= 1;
            $fbManager->set($groupUrl, $currentTime);
       }

       sleep(1);
    }
?>