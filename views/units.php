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
//Header
include_once './components/header.php';
//Sidebar
include_once './components/nav.php';
?>
<!--UNITS-->
<div class='container flex-col w-full items-center justify-center p-6 pt-14' id='units-holder'>
            <!-- <div class='flex flex-row items-center justify-between p-2 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl border-gray-100 border-2 p-6 hover:shadow-2xl'>
                <div class='flex-3 justify-self-start'>
                    <div class='text-gray-600 text-sm'>
                        Advanced Database
                    </div>
                </div>
                <div class='flex justify-between items-center w-1/4'>
                    <i class='far fa-edit text-blue-500 block'></i>
                    <i class='fas fa-trash-alt text-red-500 block'></i>
                </div>
              
            </div>   -->

</div>

<div class='container flex-col w-full items-center justify-center p-6 pt-0'>

            <div class='select-none rounded-md flex flex-1 items-center p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl p-6 mt-3 border-gray-300 hover:shadow-2xl' id='unit-plus-btn'>
                <div class='ml-24 w-1/4 text-wrap items-center flex flex-col text-white text-bold rounded-md bg-green-500 justify-center items-center mr-10 p-2'>
                    <i class='fas fa-plus'></i>
                </div>
            </div>
            
            <div class='rounded-md flex flex-1 items-center justify-between p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl mt-3 border-gray-300 hover:shadow-2xl' id='add-unit-form' style='display:none;'>
                <input class='flex-3 focus:outline-none' type='text' placeholder='Enter Unit name' id='unit-name-input'/>
                <button class='w-1/4 bg-blue-500 text-white rounded-md p-1' id='unit-form-submit-btn'>
                    Add
                </button>
             </div>

            

</div>
<script>
    document.querySelector('#page-title').innerHTML = 'Units'
</script>
<?php
    include('components/scripts.inc.php');
?>
<footer>
  <script src='js/unit/general.js'></script>
  <script src='js/unit/add.js'></script>
  <script src='js/unit/update.js'></script>
  <script src='js/unit/delete.js'></script>
</footer>
</body>
</html>