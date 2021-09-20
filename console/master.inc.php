<?php

if(function_exists("getallheaders")){
   $headers = getallheaders();
   
   if($headers !== false && count((array)$headers) > 0){
      exit();
   }
}


require(__DIR__."/../vendor/autoload.php");
require(__DIR__. "/../src/includes/passwords.inc.php");
require(__DIR__."/../src/includes/phpmailer.inc.php");
/** 
 * Include classes as needed and interfaces as needed
 */

spl_autoload_register(function($name){
   $classname = strtolower($name);
   $filename = __DIR__. "/../src/classes/$classname.class.php";
   if(file_exists($filename)){
      include($filename);
   }
});

?>