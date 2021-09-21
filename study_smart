<?php

if($argc < 2){
    echo "command: `php study_smart --migrate` to migrate the database. Please ensure that a database called study_smart_db exist already";
    exit;
}
    switch($argv[1]){
        case "--migrate":
            {
                echo shell_exec("php ./src/database/migration.php");
                break;
            }
        default:
        {
            echo "command: `php study_smart --migrate` to migrate the database. Please ensure that a database called study_smart_db exist already";
        }
    }

?>