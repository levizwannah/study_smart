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
include_once "./components/header.php";
//Sidebar
  include_once "./components/nav.php";
?>
<!--Tasks List-->
<div class="container mb-2 flex mx-auto w-full items-center justify-center">
    <ul class="flex flex-col p-4">
        <li class="border-gray-400 flex flex-row">
            <div class="select-none flex flex-1 items-center p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl border-gray-100 border-2 p-6 hover:shadow-2xl">
                <div class="flex-1 pl-1 mr-16">
                    <div class="text-gray-600 text-sm">
                        Advanced Database
                    </div>
                </div>
                <div class="w-1/4 text-wrap text-center flex text-white text-bold flex-col rounded-md bg-green-500 justify-center items-center mr-10 p-2">
                    <i class="far fa-edit"></i>
                </div>
                <div class="w-1/4 text-wrap text-center flex text-white text-bold flex-col rounded-md bg-red-500 justify-center items-center mr-10 p-2">
                    <i class="fas fa-trash-alt"></i>
                </div>
            </div>
        </li>

        <!--Add Unit-->
        <li class="border-gray-400 flex flex-row mb-2">
            <div class="select-none rounded-md flex flex-1 items-center p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-2xl p-6 mt-3 border-gray-300 hover:shadow-2xl">
                <div class="ml-24 w-1/4 text-wrap items-center flex flex-col text-white text-bold rounded-md bg-green-500 justify-center items-center mr-10 p-2">
                    <i class="fas fa-plus"></i>
                </div>
            </div>
        </li>
    </ul>
</div>
</body>
</html>