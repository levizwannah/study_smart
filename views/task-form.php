<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <title>Study Smart</title>
</head>
<body>
<?php
//Header
//include_once "./components/header.php";
//Sidebar
  //include_once "./components/nav.php";
?>
<div id="success-div"></div>
<div id="error-div"></div>
<div id="main-nav"></div>
<div id="menu_bars"></div>
<form action="">
<div class="p-6 pb-4 space-y-6 text-gray-600">

    <!--task name-->
    <div class="flex flex-row space-x-2">
        <label class="font-medium" for="task-name">Task name</label>
        <input class="border rounded-md focus:outline-none" type="text" name="task-name" id="task-name" value="">
    </div>
    <!--No. of tasks-->
    <div class="flex flex-row space-x-2">
        <label class="font-medium" for="tasks">Number of tasks</label>
        <input class="border rounded-md focus:outline-none" type="number" min="1" name="number-Of-tasks" id="number-Of-tasks">
    </div>
    <!--Category-->
    <div class="flex flex-row space-x-2">
        <label class="font-medium" for="tasks">Category</label>
        <select class="border rounded-md focus:outline-none" name="category" id="category">
            <option value="1">Assignments</option>
            <option value="2">Projects</option>
            <option value="3">Groupworks</option>
        </select>
    </div>
    <!--No. of tasks-->
    <div class="flex flex-row space-x-2">
        <label class="font-medium" for="tasks">Units</label>
        <select class='border rounded-md focus:outline-none' name='units-select' id='units-select'>

        </select>
    </div>
    <div class="flex flex-col">
        <label class="font-medium" for="dateGiven">Date Given</label>
        <input class="border:none focus:outline-none"type="date" name="date-given" id="date-given">
    </div>
    <!--Date Due-->
    <div class="flex flex-col">
        <label class="font-medium" for="dateDue">Date Due</label>
        <input type="date" name="date-due" id="date-due">
    </div>
    <!--Button-->
    <div class="select-none rounded-md flex flex-1 items-center p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl p-6 mt-3 border-gray-300 hover:shadow-2xl" onclick="addTask()">
                <div class="ml-24 w-1/4 text-wrap items-center flex flex-col text-white text-bold rounded-md bg-green-500 justify-center items-center mr-10 p-2">
                    <p>Add</p>
                </div>
            </div>
</div>

</form>
</body>
<script src="js/general.js"></script>
<script src="js/task/general.js"></script>
<script src="js/task/addTask.js"></script>
</html>