<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href='style.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <title>Study Smart</title>
</head>
<body>
<?php

 $categoryId = (int)$_GET['c'];
 if($categoryId < 1){
     $categoryId = 1;
 }

//Header
include_once './components/header.php';
//Sidebar
include_once './components/nav.php';
?>

<!-- For listing the unit -->
<div id='show-units-list' class='flex items-center justify-center mt-16 bg-green-100 p-2 rounded-md mr-10 ml-10'>
    <p id='selected-unit-name'>Mathematics chemistry<p> <div  class='ml-2 text-green-500'><i class='fas fa-caret-square-down'></i></div>
</div>

<div class='flex items-center justify-center mr-10 ml-10' style='display: none;'>
    <select id='units-select'>
    </select>
</div>

<input type='hidden' id='category-id' value='<?php echo $categoryId ?>'>

<div class='w-full mt-5 overflow-auto'>

    <div class='w-full flex flex-nowrap items-center px-10' id='tasks-holder'>

      <!-- Card View-->
      
      <!-- Card View-->
      

      
    </div>
</div>

<div id='select-status' class='flex items-center justify-between mt-1 p-2 rounded-md mr-10 ml-10 text-lg bg-red-200'>
    <label for='task-status'>Status:</label>
    <select id='task-status' class='w-3/4 rounded'>
        <option value='0'>Not Started</option>
        <option value='1'>Doing</option>
        <option value='2'>Done</option>
        <option value='3'>Submitted</option>
    </select>
</div>
<script>
    document.querySelector('#page-title').innerHTML = document.getElementById(`c-<?php echo $categoryId ?>`).querySelectorAll('span')[1].innerHTML;
</script>
<?php
    include('components/scripts.inc.php');
?>
<footer>
  <script src='js/task/general.js'></script>
  <script src='js/task/addTask.js'></script>
  <script src='js/task/editask.js'></script>
  <script src='js/task/changestatus.js'></script>
  <script src='js/task/getstatus.js'></script>
  <script src='js/task/delete.js'></script>
</footer>
</body>
</html>