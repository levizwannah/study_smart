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
  include_once "./components/header.php";
  include_once "./components/nav.php";
?>
<!--Sign Up-->
<form class="p-6 pb-4 space-y-6 text-gray-600 mt-16" method="POST">
    <div class="flex flex-col mb-6">
        <label for="firstname" class="font-medium" >First Name</label>
        <input type="text" name="firstname" id="firstname" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="lastname" class="font-medium">Last Name</label>
        <input type="text" name="lastname" id="lastname" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="email" class="font-medium">Email</label>
        <input type="email" name="email" id="email" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="password" class="font-medium">Password</label>
        <input type="password" name="password" id="password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="cpassword" class="font-medium">Confirm Password</label>
        <input type="password" name="cpassword" id="c-password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-4">
        <button type="button" id="" class="rounded-md text-white bg-green-500 w-full py-2 px-4 text-sm font-bold" onclick="register()">Sign Up</button>
        <span class="mb-3">Already have an account? <a href="login.php" class="text-green-500 text-gray-500 hover:underline">Login</a></span>
    </div>
</form>

<script>
    document.getElementById("menu_bars").style.visibility = "hidden";
    document.getElementById("edit-profile").style.visibility = "hidden";
    document.getElementById("page-title").innerHTML = "Study_Smart: Register"
</script>
<?php
    include('components/scripts.inc.php');
?>
<footer>
  <script src='js/user/signup.js'></script>
</footer>
</body>
</html>
