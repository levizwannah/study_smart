
<nav class="absolute top-0 left-0 min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800 mt-14  z-30 transition-all" style="left: -100%" id="main-nav">
    <div class="fixed flex flex-col w-64 bg-white h-full border-r">
      
      <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
          <li class="px-5">
            <h1>Study Smart</h1>
          </li>
          <!-- View Profile Picture-->
          <li class="flex items-center hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-b hover:border-indigo-500 p-6">
             <img id = "nav-profile-image" class="relative w-24 h-24 rounded-full border border-gray-100 shadow-sm" src="https://randomuser.me/api/portraits/women/81.jpg" alt="User Image" onclick="location.href='editProfile.php'"/> <span id="nav-user-full-name"> Levi Zwannah </span>
                <!-- <span><i class="fas fa-camera"></i></span> -->
          </li>
          <!--Assignments-->
          <li>
            <a id="c-1" href="tasks.php?c=1" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="fas fa-book"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Assignments</span>
              <!-- <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-indigo-500 bg-indigo-50 rounded-full">New</span> -->
            </a>
          </li>
          <!--Projects-->
          <li>
            <a id="c-2" href="tasks.php?c=2" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="fas fa-project-diagram"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Projects</span>
            </a>
          </li>
          <!--Groupwork-->
          <li>
            <a id="c-3" href="tasks.php?c=3" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Groupworks</span>
              <!-- <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-50 rounded-full">3</span> -->
            </a>
          </li>
          <!--Units-->
          <li>
            <a id="unit-nav-link" href="units.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                 <i class="fas fa-book"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Units</span>
            </a>
          </li>
          <!--User Profile-->
          <li class="px-5">
            <div class="flex flex-row items-center h-8">
              <div class="text-sm font-light tracking-wide text-gray-500">Edit Profile</div>
            </div>
          </li>
          <!--Edit Profile-->
          <li>
            <a id="edit-profile-nav-link" href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="far fa-user"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Edit Profile</span>
            </a>
          </li>
          <!--3. Logout-->
          <li class="px-5">
            <div class="flex flex-row items-center h-8">
              <div class="text-sm font-light tracking-wide text-gray-500">Settings</div>
            </div>
          </li>
        
          <li>
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="fas fa-sign-out-alt"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Including the notification.php -->
  <?php
    include(__DIR__."/notification.php");
  ?>
