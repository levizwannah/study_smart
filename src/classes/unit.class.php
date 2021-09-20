<?php
 /**
  * Unit class
  */

  class Unit{
      private $id,
              $name,
              $userId,
              $createdOn,
              $updatedOn;

      const UNIT_TABLE = "unit",
            UNIT_ID = "unit_id",
            UNIT_FOREIGN_KEY = "unitId";

        public function __construct($id = 0)
        {
            if((int)$id > 0){
                $this->setId($id);
                $this->loadUnit($id);
            }
        }

        public function loadUnit($id){
            $dbManager = new DbManager($id);

            $unitInfo = $dbManager->query(Unit::UNIT_TABLE, ["*"], Unit::UNIT_ID."= ?", [$id]);

            if($unitInfo === false){
                return false;
            }

            $this->setName($unitInfo["unit_name"]);
            $this->setUserId($unitInfo[User::USER_FOREIGN_KEY]);
            $this->setCreatedOn($unitInfo["created_on"]);
            $this->setUpdatedOn($unitInfo["updated_on"]);
            return true;
        }

        /**
         * Name and userId properties must be set
         */
        public function add(){

            if(empty($this->name)){
                return -1;
            }

            $dbManager = new DbManager();

            return $dbManager->insert(Unit::UNIT_TABLE, ["name", User::USER_FOREIGN_KEY], [$this->name, $this->userId]);
        }

        /**
         * checks if a unit exists
         */
        public function exists(){
            if((new DbManager())->query(Unit::UNIT_TABLE, [Unit::UNIT_ID], "unit_name = ? and ". User::USER_FOREIGN_KEY . " = ?", [$this->name, $this->userId]) === false){
                return false;
            }

            return true;
        }


        /**
         * updates a unit. the unit name and userId must be set
         */
        public function update(){
            if(empty($this->userId)){
                return false;
            }

            if(empty($this->name)){
                return false;
            }

            if(empty($this->id)){
                return false;
            }

            return (new DbManager())->update(Unit::UNIT_TABLE, "name = ?", [$this->name], Unit::UNIT_ID ." = ?", [$this->id]);
        }

        public  function delete()
        {
            return (new DbManager())->delete(Unit::UNIT_TABLE, Unit::UNIT_ID ." = ?", [$this->id]);
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

        

        /**
         * Get the value of userId
         */ 
        public function getUserId()
        {
                    return $this->userId;
        }

        /**
         * Set the value of userId
         *
         * @return  self
         */ 
        public function setUserId($userId)
        {
                    $this->userId = $userId;

                    return $this;
        }
  }
?>