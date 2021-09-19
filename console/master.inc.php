<?php

if(function_exists("getallheaders")){
   $headers = getallheaders();
   
   if($headers !== false && count((array)$headers) > 0){
      exit();
   }
}


require(__DIR__."/../ot_server/vendor/autoload.php");
require(__DIR__. "/../ot_server/src/includes/passwords.inc.php");
/** 
 * Include classes as needed and interfaces as needed
 */

spl_autoload_register(function($name){
   $classname = strtolower($name);
   $filename = __DIR__. "/../ot_server/src/classes/$classname.class.php";
   if(file_exists($filename)){
      include($filename);
   }
});

?>