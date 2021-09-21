<?php

    require("master.inc.php");

    $categoryId = isset($_POST["category-id"])? (int)$_POST["category-id"]: 1;

    $status = isset($_POST["task-status"])? abs((int)$_POST["task-status"]): Task::STATUS_NOT_STARTED;

    $unitId = isset($_POST["unit-id"])? (int)$_POST["unit-id"]: 0;

    $dbManager = new DbManager();

    //this will be inefficient for now

    $allTasksIds = $dbManager->query(Task::TASK_TABLE, [Task::TASK_ID],  "task_status = ? and ". User::USER_FOREIGN_KEY. " = ? and ". Category::CAT_FOREIGN_KEY . " = ? and ". Unit::UNIT_FOREIGN_KEY . " =?", [Task::TASK_STATUSES[$status], $userId, $categoryId, $unitId], true, true);

    if($allTasksIds === false){
        exit(Response::SQE());
    }

    $tasksHtml = "";
    foreach($allTasksIds as $taskIdInfo){
        $task = new Task($taskIdInfo[Task::TASK_ID]);
        $taskId = $task->getId();
        
        $totalQuestions = $task->getNumOfQuestions();
        $totalDone = $task->getQuestionsDone();
        $given = Utility::returnDate(strtotime($task->getGivenDate()));
        $deadline = Utility::returnDate(strtotime($task->getDeadline()));
        $taskName = $task->getName();

        $checkboxes = "";
        for($i = 0; $i < $totalQuestions; $i++){
            if($i < $totalDone){
                $checkboxes .= "<div>
                <label class='inline-flex items-center'>
                    <input type='checkbox' class='' checked>
                </label>
                </div>";
                continue;
            }

            $checkboxes .= "<div>
            <label class='inline-flex items-center'>
                <input type='checkbox' class=''>
            </label>
            </div>";
        
        }

        $submitButton = "<p></p>";

        if($task->getStatus() == Task::TASK_STATUSES[Task::STATUS_DONE]){
            $submitButton = "<button class='bg-green-500 text-white rounded-md p-2' onclick='submit($taskId, $totalQuestions)'>Submit</button>";
        }

        $tasksHtml .= "<div id='task-$taskId' class='p-4 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-md border-gray-300 hover:shadow-md flex-shrink-0 min-w-full mr-10'>
        <input type='hidden' id='total-questions-t-$taskId'  value='$totalQuestions'>
        <input type='hidden' id='total-completed-t-$taskId'  value='$totalDone'>

        <div class='bg-white px-6 py-8 rounded-lg shadow-lg text-center'>
            <p id='name'>$taskName</p>
            <!--Progress Bar-->
            <div class='relative pt-1'>
                <div class='flex mb-2 items-center justify-between'>
                    <div>
                    <span class='text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-gray-600 bg-gray-200'>
                        Progress
                    </span>
                    </div>
                    <div class='text-right'>
                    <span id='percent-t-$taskId' class='text-xs font-semibold inline-block text-green-400'>
                        0%
                    </span>
                    </div>
                </div>
                <div  class='overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200'>
                    <div id='p-range-h-t-$taskId' style='width:0'
                     class='shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-400 transition-all'>
                    </div>
                </div>
            </div>
            <!--End of progress bar-->

            <!--Check box-->
            <div class='block border rounded-md'>
                <span class='text-gray-600'>Number of Tasks</span>
                <div class='flex flex-wrap space-x-4 m-4 items-center justify-even'>
                    $checkboxes
                </div>
            </div>
            <!--End of check box-->

            <!--Date given-->
            <div class = 'mt-2'>
                <p class='font-medium'>Date Given</p>
                <p class='text-gray-600'>$given</p>
            </div>

            <!--Date Due-->
            <div class='mt-2'>
                <p class='font-medium'>Date Due</p>
                <p class='text-gray-600'>$deadline</p>
            </div>
            

            <!--Submit-->
            <!--Complete-->
            <div class='flex mt-8 items-center justify-between'>
                <!--Delete-->
                <button class='bg-red-100 rounded-md p-1' onclick='deleteTask($taskId)'>
                    <i class='fas fa-trash-alt block text-red-500'></i>
                </button>
                <!--Submit-->
                $submitButton
            </div>
        </div>
      </div>
      <!-- Card view end -->
";
    }

    $tasksHtml .= "<div id='show-add-task-form' class='p-10 transition duration-500 ease-in-out transform hover:-translate-y-2 rounded-md border-gray-300 hover:shadow-md flex-shrink-0 mr-16'>
    <div class='bg-white px-6 py-8 rounded-lg shadow-lg text-center'>
        
        <div class='block border rounded-full'>
          <i class='fas fa-plus-circle text-9xl text-green-500'></i>
        </div>
    </div>
  </div>";

    exit(Response::makeResponse("OK", $tasksHtml));
?>