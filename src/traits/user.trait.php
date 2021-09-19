<?php

    trait UserTrait{

        /**
         * Checks if an email exist already
         * @param string $email
         * @param DatabaseInterface $dbManager
         * @return bool
         */
        public static function doesEmailExist($email, DatabaseInterface $dbManager){
            return UserTrait::doesExist($email, "email", $dbManager);
        }

        /**
         * Checks if a phone number exists already
         * @param string $phone
         * @param DatabaseInterface $dbManager
         * @return bool
         */
        public static function doesPhoneNumberExist($phone, DatabaseInterface $dbManager){
            return UserTrait::doesExist($phone, "phone", $dbManager);
        }

        public static function doesExist($what, $columnName, DatabaseInterface $dbManager){
            $table = "user";
            $columns = [$columnName];
            $values = [$what];

            $dbManager->setFetchAll(false);
            $result = $dbManager->query($table, $columns, "$columnName = ?", $values);

            if($result && count($result) > 0){
                return true;
            }
            return false;
        }

        /**
         * This method sends the confirmation email to the user.
         * The id and the email of the object should be set before this method is called.
         * include the phpmailer.inc.php file to make this function work
         */
        public static function sendConfirmationEmail($id, $email, DatabaseInterface $dbManager){
         
            $code = Utility::make6digitCode();

            if($dbManager->update("user", "ev_code = ?", [$code], "id = ?", [$id])){
                $sub = "Verify your email";
                $msg = "Your email verification code is $code";
    
                return sendEmail($email, $email, $sub, $msg);
            }
            return false;
        }
        
    }

?>