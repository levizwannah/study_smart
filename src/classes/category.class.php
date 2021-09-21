<?php

/**
 * Category class
 */

 class Category{
     private $id,
             $name,
             $createdOn,
             $updatedOn;

    const CATEGORY_TABLE = "category",
          CATEGORY_ID = "category_id",
          CAT_FOREIGN_KEY = "categoryId";


        public function __construct($id = 0)
        {
            if((int)$id > 0){
                $this->setId($id);
                $this->loadCategory($id);
            }
        }


        /**
         * Loads a category data from the database
         */
        public function loadCategory($id){
            $dbManager = new DbManager();

            $catInfo = $dbManager->query(Category::CATEGORY_TABLE, ["*"], Category::CATEGORY_ID. "= ?", [$id]);

            if($catInfo === false){
                return false;
            }

            $this->setName($catInfo["category_name"]);
            $this->setCreatedOn($catInfo["created_on"]);
            $this->setUpdatedOn($catInfo["updated_on"]);
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
        public function exists(){
            if((new DbManager())->query(Category::CATEGORY_TABLE, [Category::CATEGORY_ID], "category_name = ?", [$this->name]) === false){
                return false;
            }

            return true;
        }
 }

?>