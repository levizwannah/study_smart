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
<!--Edit Profile-->
<form class="p-6 pb-4 space-y-6 text-gray-600 mt-16" method="POST" enctype="multipart/form-data">
    
    <!-- View Profile Picture-->
    <div class="flex items-center hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-b hover:border-indigo-500 p-6">
             <img id = "profile-image" class="relative w-24 h-24 rounded-full border border-gray-100 shadow-sm" alt="User Image" onclick="location.href='edit-profile.php'"/> <input type="file" id="profile-image-input" accept="image/*" onchange="uploadImage()" class="">
    
                
    </div>

    <div class="flex flex-col mb-6">
        <label for="firstname" class="font-medium">First Name</label>
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
    <div class="flex flex-col mb-4">
        <button type="button" id="" class="rounded-md text-white bg-green-500 w-full py-2 px-4 text-sm font-bold" onclick="updateProfile()">Update profile</button>
    </div>
    <div class="flex flex-col mb-6">
        <label for="oldpassword" class="font-medium">Current Password</label>
        <input type="password" name="oldpassword" id="old-password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="newpassword" class="font-medium">New Password</label>
        <input type="password" name="newpassword" id="new-password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-6">
        <label for="cpassword" class="font-medium">Confirm Password</label>
        <input type="password" name="cpassword" id="c-password" class="text-sm text-gray-500 py-2 px-4 rounded-3xl border focus:outline-none">
    </div>
    <div class="flex flex-col mb-4">
        <button type="button" id="" class="rounded-md text-white bg-green-500 w-full py-2 px-4 text-sm font-bold" onclick = "resetPassword()">Reset Password</button>
    </div>
    <div class="flex flex-col mb-4">
        <button type="button" id="" class="rounded-md text-white bg-blue-500 w-full py-2 px-4 text-sm font-bold" onclick = "location.href='confirm-email.php'">Confirm Email</button>
    </div>
</form>

<script>
    document.getElementById("page-title").innerHTML = "Edit profile"
</script>
<?php
    include('components/scripts.inc.php');
?>
<footer>
  <script src='js/user/editprofile.js'></script>
</footer>
</body>
</html>
