<?php
/**
 * Migrates the database
 */
 require(__DIR__ . "/../../vendor/autoload.php");
//  use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

 require("../interfaces/database.interface.php");
 require("../classes/dbmanager.class.php");



 class Migrator{
     const SCHEMA = "schema.sql";

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