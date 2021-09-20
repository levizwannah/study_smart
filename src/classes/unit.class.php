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