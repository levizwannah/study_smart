
<script>
  let user = window.localStorage.getItem("user");

  user = {
    token: "",
    firstName: "Levi",
    lastName: "Zwannah",
    profileImage: "pic.jpeg"
  }
</script>

<nav class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
    <div class="fixed flex flex-col top-0 left-0 w-64 bg-white h-full border-r">
      <div class="flex items-center justify-center h-10 border-b">
        <div><i class="fas fa-bars"></i></div>
      </div>
      <div class="overflow-y-auto overflow-x-hidden flex-grow">
        <ul class="flex flex-col py-4 space-y-1">
          <li class="px-5">

          </li>
          <!-- View Profile Picture-->
          <li class="lex items-center hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-b hover:border-indigo-500 p-6">
             <img class="relative w-24 h-24 rounded-full border border-gray-100 shadow-sm" src="https://randomuser.me/api/portraits/women/81.jpg" alt="User Image" /> <span> Levi Zwannah </span>
                <!-- <span><i class="fas fa-camera"></i></span> -->
          </li>
          <!--Assignments-->
          <li>
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="fas fa-book"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Assignments</span>
              <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-indigo-500 bg-indigo-50 rounded-full">New</span>
            </a>
          </li>
          <!--Projects-->
          <li>
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <i class="fas fa-project-diagram"></i>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Projects</span>
            </a>
          </li>
          <!--Groupwork-->
          <li>
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
              <span class="inline-flex justify-center items-center ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
              </span>
              <span class="ml-2 text-sm tracking-wide truncate">Groupwork</span>
              <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-50 rounded-full">3</span>
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
            <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
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

  <!--Including the general.js -->
