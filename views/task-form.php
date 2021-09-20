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
<div class="p-6 pb-4 space-y-6 text-gray-600">
    <!--No. of tasks-->
    <div class="flex flex-row space-x-2">
        <label class="font-medium" for="tasks">Number of tasks</label>
        <input class="border rounded-md focus:outline-none"type="number" name="tasks" id="tasks">
    </div>
    <!--Date given-->
    <div class="flex flex-col">
        <label class="font-medium" for="dateGiven">Date Given</label>
        <input class="border:none focus:outline-none"type="date" name="dateGiven" id="dateGiven">
    </div>
    <!--Date Due-->
    <div class="flex flex-col">
        <label class="font-medium" for="dateDue">Date Due</label>
        <input type="date" name="dateDue" id="dateDue">
    </div>
    <!--Button-->
    <div class="select-none rounded-md flex flex-1 items-center p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl p-6 mt-3 border-gray-300 hover:shadow-2xl">
                <div class="ml-24 w-1/4 text-wrap items-center flex flex-col text-white text-bold rounded-md bg-green-500 justify-center items-center mr-10 p-2">
                    <p>Add</p>
                </div>
            </div>
</div>
</body>
</html>