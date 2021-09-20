<?php

    class Response{

        /**
         * Programming Error
         * @return string
         */
        public static function PE(){
            return Response::makeResponse(
                "PE",
                "You made a programming error. Either scripts are not included correctly"
            );
        }
        
        /**
         * Wrong Email Error
         * @return string 
         */
        public static function WEE(){
            return json_encode([
            "status" => "WEE", 
            "message" => "You entered an invalid credential"
        ]);}

        /**
         * SQL Error
         * @return string
         */
        public static function SQE(){
            return json_encode(
            ["status" => "SQL", 
            "message" => "An internal System error occurred"
        ]);}

        /**
         * Wrong Password Error
         * @return string
         */
        public static function WPE(){
            return json_encode([
            "status" => "WPE", 
            "message" => "You entered an invalid credential"
        ]);}

        /**
         * No Password Error
         * @return string
         */
        public static function NPE(){
            return json_encode([
            "status" => "NPE", 
            "message" => "Password is required"
        ]);}

        /**
         * No Email Error
         * @return string
         */
        public static function NEE(){
            return json_encode([
            "status" => "NEE", 
            "message" => "Email is required"
        ]);}

        /**
         * No ID Error
         * @return string
         */
        public static function NIE(){
            return json_encode([
            "status" => "NIE", 
            "message" => "It is like you are not logged in"
        ]);}

        /**
         * Email Exist Error
         * @return string
         */
        public static function EEE(){
            return json_encode([
            "status" => "EEE", 
            "message" => "The email already exist"
        ]);}

        /**
         * Unqualified Email Error
         * @return string
         */
        public static function UEE(){
            return json_encode([
            "status" => "UEE", 
            "message" => "The email is invalid."
        ]);}

        /**
         * Uqualified Name Error
         * @return string
         */
        public static function UNE(){
            return Response::makeResponse("UNE", "The name contains unaccepted characters");
        }

        /**
         * Invalid Image Error
         * @return string
         */
        public static function IIE(){
            return Response::makeResponse("IEE", "The image you entered is invalid. Accepted image types are: .jpeg, .png, .gif, .bmp, .webp");
        }

        /**
         * User Not Found Error
         * @return string
         */
        public static function UNFE(){
            return json_encode([
            "status" => "UNFE", 
            "message" => "Could not find user with the given credential"
        ]);}

        /**
         * Uknown Error Occurred
         * @return string
         */
        public static function UEO(){
            return json_encode([
            "status" => "UEO", 
            "message" => "An unknown error occurred"
        ]);}

        /**
         * Cannont Update User Error
         * @return string
         */
        public static function CUUE(){
            return json_encode([
            "status" => "CUUE", 
            "message" => "To update your account, your first name, last name, email, phone number, and profile image must be set"
        ]);}

        /**
         * Change Password Token Not Found Error
         * @return string
         */
        public static function CPTNFE(){
            return json_encode([
            "status" => "CPTNFE", 
            "message" => "You entered the wrong codes"
        ]);}

        /**
         * Change Password Expired Token Error
         * @return string
         */
        public static function CPETE(){
            return json_encode([
            "status" => "CPETE", 
            "message" => "The codes has expired"
        ]);}

        /**
         * General OK
         * @return string
         */
        public static function OK(){
            return json_encode([
            "status" => "OK", 
            "message" => "success"
        ]);}

        /**
         * Already Logged In Error
         * @return string
         */
        public static function ALIE(){
            return json_encode([
            "status" => "ALIE", 
            "message" => "You are already logged in"
        ]);}

        /**
         * Not Logged In Error
         * @return string
         */
        public static function NLIE(){
            return json_encode([
            "status" => "NLIE", 
            "message" => "You are not logged in"
        ]);}

        /**
         * Make a new response
         * @param string $status - Status code
         * @param string $message - The message to send
         * @return string
         */
        public static function makeResponse($status, $message){
            $response = [
                "status" => $status, 
                "message" => $message
            ];
            return json_encode($response);
        }

       
    }

?>