<?php

    interface DatabaseInterface{
        /**
         * Connects to the database using the information in the .env folder.
         */
        public function connect();

        public function query($table, $columns, $condition_string, $condition_values);
        public function insert($table, $columns, $values);
        public function delete($table, $condition_string, $condition_values);
        public function update($table, $columns_string, $values, $condition_string, $condition_values);
        public function rawSql($sql);
        public function getAffRowsCount();
        public function close();
    }

?>