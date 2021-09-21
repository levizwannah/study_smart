<?php

    require("master.inc.php");

    $categoryId = isset($_POST["category-id"])? (int)$_POST["category-id"]: 1;

    $status = isset($_POST["task-status"])? abs((int)$_POST["task-status"]): Task::STATUS_NOT_STARTED;

    $dbManager = new DbManager();

    //this will be inefficient for now

    $allTasksIds = $dbManager->query(Task::TASK_TABLE, [Task::TASK_ID],  "task_status = ? and ". User::USER_FOREIGN_KEY. " = ? and ". Category::CAT_FOREIGN_KEY . " = ?", [Task::TASK_STATUSES[$status], $userId, $categoryId], true, true);

    if($allTasksIds === false){
        exit(Response::SQE());
    }

    $tasksHtml = "";
    foreach($allTasksIds as $taskIdInfo){
        $task = new Task($taskIdInfo[Task::TASK_ID]);
        $tasksHtml.= "
        <div id='task-id' class='p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-md border-gray-300 hover:shadow-md flex-shrink-0 mr-10'>
        <input type='hidden' id='total-questions-t-id'  value=''>
        <input type='hidden' id='total-completed-t-id'  value=''>

        <div class='bg-white px-6 py-8 rounded-lg shadow-lg text-center'>
            <p id='name'>Take Home CAT</p>
            <!--Progress Bar-->
            <div class='relative pt-1'>
                <div class='flex mb-2 items-center justify-between'>
                    <div>
                    <span class='text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200'>
                        Progress
                    </span>
                    </div>
                    <div class='text-right'>
                    <span id='percent-t-id' class='text-xs font-semibold inline-block text-green-400'>
                        60%
                    </span>
                    </div>
                </div>
                <div id='p-range-h-t-id' class='overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200'>
                    <div id='' style='width:30%'
                     class='shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400'>
                    </div>
                </div>
            </div>
            <!--End of progress bar-->

            <!--Check box-->
            <div class='block border rounded-md'>
                <span class='text-gray-600'>Number of Tasks</span>
                <div class='flex flex-wrap space-x-4 m-4 items-center justify-between'>
                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='' checked>
                    </label>
                    </div>
                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='form-checkbox'>
                    </label>
                    </div>
                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='form-checkbox'>
                    </label>
                    </div>

                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='' checked>
                    </label>
                    </div>
                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='form-checkbox'>
                    </label>
                    </div>
                    <div>
                    <label class='inline-flex items-center'>
                        <input type='checkbox' class='form-checkbox'>
                    </label>
                    </div>
                </div>
            </div>
            <!--End of check box-->

            <!--Date given-->
            <div class = 'mt-2'>
                <p class='font-medium'>Date Given</p>
                <p class='text-gray-600'>24/04/2021</p>
            </div>

            <!--Date Due-->
            <div class='mt-2'>
                <p class='font-medium'>Date Due</p>
                <p class='text-gray-600'>24/05/2021</p>
            </div>

            <!--Submit-->
            <!--Complete-->
            <div class='flex mt-8 items-center justify-between'>
                <!--Delete-->
                <button class='bg-red-100 rounded-md p-1'>
                    <i class='fas fa-trash-alt block text-red-500'></i>
                </button>
                <!--Submit-->
                <button class='bg-green-500 text-white rounded-md p-1'>Submit</button>
            </div>
        </div>
      </div>";
    }

    exit(Response::makeResponse("OK", $tasksHtml));
?>