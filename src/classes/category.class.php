<?php

/**
 * Category class
 */

 class Category{
     private $id,
             $name,
             $createdOn,
             $updatedOn;

        public function __construct($id = 0)
        {

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
 }

?>