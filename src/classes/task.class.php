<?php
 
 /**
  * The Task class
  */

  class Task{
      private $id,
              $name,
              $unit,
              $category,
              $numOfQuestions,
              $questionsDone,
              $deadline,
              $status,
              $createdOn,
              $updatedOn;

      const TASK_TABLE = "task",
            TASK_ID = "task_id",
            STATUS_NOT_STARTED = 0,
            STATUS_DOING = 1,
            STATUS_DONE = 2,
            STATUS_SUBMITTED = 3;

      const TASK_STATUSES = ["not_started", "doing", "done", "submitted"];

        public function __construct($id = 0){
                if((int)$id > 0){
                        $this->setId($id);
                        $this->loadTask($id);
                }
        }

        public function loadTask($id){
            $dbManager = new DbManager();
            $taskInfo = $dbManager->query(Task::TASK_TABLE, ["*"], Task::TASK_ID . "= ?", [$id]);

            if($taskInfo === false){
                    return false;
            }

            $this->setName($taskInfo["task_name"]);
            $this->setUnit(new Unit($taskInfo[Unit::UNIT_ID]));
            $this->setCategory(new Category($taskInfo[Category::CATEGORY_ID]));
            $this->setDeadline($taskInfo["deadline"]);
            $this->setNumOfQuestions($taskInfo["num_of_questions"]);
            $this->setQuestionsDone($taskInfo["num_done"]);
            $this->setStatus($taskInfo["task_status"]);
            $this->setCreatedOn($taskInfo["created_on"]);
            $this->setUpdatedOn($taskInfo["updated_on"]);
            return true;
        }

        /**
         * changes the status of tasks should be one of the constants
         * @param int $newStatus - new status
         */
        public function changeStatus($newStatus){
                $dbManager = new DbManager();
                if(!isset($this->id)){
                        return false;
                }

                return $dbManager->update(Task::TASK_TABLE, "task_status = ?", [Task::TASK_STATUSES[$newStatus % count(Task::TASK_STATUSES)]], Task::TASK_ID ." = ?", [$this->id]);
        }


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                    return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                    $this->name = $name;

                    return $this;
        }

        /**
         * Get the value of unit
         */ 
        public function getUnit()
        {
                    return $this->unit;
        }

        /**
         * Set the value of unit
         *
         * @return  self
         */ 
        public function setUnit($unit)
        {
                    $this->unit = $unit;

                    return $this;
        }

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                    return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                    $this->category = $category;

                    return $this;
        }

        /**
         * Get the value of numOfQuestions
         */ 
        public function getNumOfQuestions()
        {
                    return $this->numOfQuestions;
        }

        /**
         * Set the value of numOfQuestions
         *
         * @return  self
         */ 
        public function setNumOfQuestions($numOfQuestions)
        {
                    $this->numOfQuestions = $numOfQuestions;

                    return $this;
        }

        /**
         * Get the value of questionsDone
         */ 
        public function getQuestionsDone()
        {
                    return $this->questionsDone;
        }

        /**
         * Set the value of questionsDone
         *
         * @return  self
         */ 
        public function setQuestionsDone($questionsDone)
        {
                    $this->questionsDone = $questionsDone;

                    return $this;
        }

        /**
         * Get the value of deadline
         */ 
        public function getDeadline()
        {
                    return $this->deadline;
        }

        /**
         * Set the value of deadline
         *
         * @return  self
         */ 
        public function setDeadline($deadline)
        {
                    $this->deadline = $deadline;

                    return $this;
        }

        /**
         * Get the value of status
         */ 
        public function getStatus()
        {
                    return $this->status;
        }

        /**
         * Set the value of status
         *
         * @return  self
         */ 
        public function setStatus($status)
        {
                    $this->status = $status;

                    return $this;
        }

        /**
         * Get the value of createdOn
         */ 
        public function getCreatedOn()
        {
                    return $this->createdOn;
        }

        /**
         * Set the value of createdOn
         *
         * @return  self
         */ 
        public function setCreatedOn($createdOn)
        {
                    $this->createdOn = $createdOn;

                    return $this;
        }

        /**
         * Get the value of updatedOn
         */ 
        public function getUpdatedOn()
        {
                    return $this->updatedOn;
        }

        /**
         * Set the value of updatedOn
         *
         * @return  self
         */ 
        public function setUpdatedOn($updatedOn)
        {
                    $this->updatedOn = $updatedOn;

                    return $this;
        }
  }

?>