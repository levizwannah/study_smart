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

<div id="container" class="w-4/5 mx-auto">
    <div class="flex flex-col sm:flex-row">
      <!-- Card View-->
      <div class="sm:w-1/4 p-2">
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
                <span class="text-gray-600">Tasks</span>
                <div class="flex  space-x-4 m-4">
                    <div>
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox" checked>
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
            <div class="flex mt-8 space-x-4">
                <!--Delete-->
                <i class="fas fa-trash-alt"></i>
                <!--Submit-->
                <button>Submit</button>
            </div>


        </div>
      </div>
    </div>
  </div>
</body>
</html>