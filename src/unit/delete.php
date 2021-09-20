<?php
 require("master.inc.php");

 $unitId = isset($_POST["unit-id"])? (int)$_POST['unit-id']: 
 exit(Response::NIE());

 $unit = new Unit($unitId);

 if(!$unit->delete()){
    exit(Response::SQE());
 }

 exit(Response::OK());

?>