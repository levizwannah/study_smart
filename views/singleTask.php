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

<!-- For listing the unit -->
<div class="flex items-center justify-center mt-16 bg-green-100 p-2 rounded-md mr-10 ml-10">
    <p>Mathematics chemistry<p> <div class="ml-2 text-green-500"><i class="fas fa-caret-square-down"></i></div>
</div>

<div class="w-full mt-5 overflow-auto">

    <div class="w-full flex flex-nowrap items-center px-10">
      <!-- Card View-->
      <div class="p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-md border-gray-300 hover:shadow-md flex-shrink-0 mr-10">
        <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">
            <!--Progress Bar-->
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200">
                        Progress
                    </span>
                    </div>
                    <div class="text-right">
                    <span class="text-xs font-semibold inline-block text-green-400">
                        60%
                    </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                    <div style="width:30%"
                     class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400">
                    </div>
                </div>
            </div>
            <!--End of progress bar-->

            <!--Check box-->
            <div class="block border rounded-md">
                <span class="text-gray-600">Number of Tasks</span>
                <div class="flex flex-wrap space-x-4 m-4 items-center justify-between">
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="" checked>
                    </label>
                    </div>
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox">
                    </label>
                    </div>
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox">
                    </label>
                    </div>

                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="" checked>
                    </label>
                    </div>
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox">
                    </label>
                    </div>
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox">
                    </label>
                    </div>
                </div>
            </div>
            <!--End of check box-->

            <!--Date given-->
            <div class = "mt-2">
                <p class="font-medium">Date Given</p>
                <p class="text-gray-600">24/04/2021</p>
            </div>

            <!--Date Due-->
            <div class="mt-2">
                <p class="font-medium">Date Due</p>
                <p class="text-gray-600">24/05/2021</p>
            </div>

            <!--Submit-->
            <!--Complete-->
            <div class="flex mt-8 items-center justify-between">
                <!--Delete-->
                <button class="bg-red-100 rounded-md p-1">
                    <i class="fas fa-trash-alt block text-red-500"></i>
                </button>
                <!--Submit-->
                <button class="bg-green-500 text-white rounded-md p-1">Submit</button>
            </div>
        </div>

    </div>
</div>
</body>
</html>