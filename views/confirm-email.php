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
<!--Password Reset-->
<form class="p-6 pb-4 space-y-6 text-gray-600 mt-16" method="POST">

    <div class="flex flex-col mb-6">
        <label for="confrimation-code" class="font-medium">Current Password</label>
        <input type="number" name="code" id="confirmation-code" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none" placeholder="6-digit code">
    </div>
   
    <div class="flex flex-col mb-4">
        <button type="button" id="" class="rounded-md text-white bg-green-500 w-full py-2 px-4 text-sm font-bold" onclick="confirmEmail()">Confirm Email</button>
    </div>
</form>
<script>
    document.getElementById("page-title").innerHTML = "Confirm email"
</script>
<?php
    include('components/scripts.inc.php');
?>
<footer>
  <script src='js/user/confirmemail.js'></script>
</footer>
</body>
</html>
