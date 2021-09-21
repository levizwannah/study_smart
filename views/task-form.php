
<div id="myModal" class="modal">
  <div class="modal-content mt-16 rounded-md p-4 space-y-6 text-gray-600">

        <!--task name-->
        <div class="flex flex-row items-center justify-between">
            <label class="font-medium" for="task-name">Title</label>
            <input class="border rounded-md focus:outline-none p-2" type="text" name="task-name" id="task-name" value="">
        </div>
        <!--No. of tasks-->
        <div class="flex flex-row items-center justify-between">
            <label class="font-medium p-2" for="tasks">Number of tasks</label>
            <input class="border rounded-md focus:outline-none p-2 w-1/4" type="number" min="1" name="number-Of-tasks" id="number-Of-tasks">
        </div>
        <!--Category-->
        <div class="flex flex-row items-center justify-between">
            <label class="font-medium" for="tasks">Category</label>
            <select class="border rounded-md focus:outline-none p-2" name="category" id="category">
                <option value="1">Assignments</option>
                <option value="2">Projects</option>
                <option value="3">Groupworks</option>
            </select>
        </div>
        <!--No. of tasks-->
        <div class="flex flex-row items-center justify-between">
            <label class="font-medium" for="tasks">Units</label>
            <select class='border rounded-md focus:outline-none p-2' name='units-select' id='units-select'>

            </select>
        </div>
        <div class="flex justify-between">
        <div class="flex flex-col flex-shrink w-1/3">
            <label class="font-medium" for="dateGiven">Date Given</label>
            <input class="border focus:outline-none p-2"type="date" name="date-given" id="date-given">
        </div>
        <!--Date Due-->
        <div class="flex flex-col flex-shrink w-1/3">
            <label class="font-medium" for="dateDue">Date Due</label>
            <input type="date" name="date-due" id="date-due" class="border focus:outline-none p-2 w-full">
        </div>
        </div>
        
        <!--Button-->
        <div class="w-full flex justify-between items-center p-4" >
            <button id="close" class="text-white text-bold rounded-md bg-red-500 p-2 w-1/3">
                <i class="fas fa-times"></i>
            </button>
            <button id="add-task-submit-btn" class=" text-white text-bold rounded-md bg-green-500 p-2 w-1/3">
                Add
            </button>
        </div>

  </div>
  <!-- <div class="modal-footer">
    <h3>Modal Footer</h3>
  </div> -->
</div>
