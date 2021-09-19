<?php
    require("master.inc.php");
    $raManager = new RAManager();
    while(true){
        echo "disbursing";

        $raManager->loadQueue();
        $raManager->disburseRAs();
        sleep(30);

    }

   
?>