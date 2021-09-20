<?php
/**
 * Migrates the database
 */
 require(__DIR__ . "/../../vendor/autoload.php");

 require(__DIR__."/../interfaces/database.interface.php");
 require(__DIR__."/../classes/dbmanager.class.php");



 class Migrator{
     const SCHEMA = __DIR__. "/schema.sql";

     public static function migrate(){
        $query = file_get_contents(Migrator::SCHEMA);
        $query = preg_replace("/\r\n/", " ", $query);
        $dbManager = new DbManager();
        if($dbManager->makeDatabase($query)){
            echo "\nCreated the database\n";
        }
        else{
            echo "\nDidn't create the database\n";
        }
     }

 }

 Migrator::migrate();

?>