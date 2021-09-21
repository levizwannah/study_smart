<?php

    class Utility {
        public static $nameRegex = "/^[\w]+(\s?[\w\-_\'\.]+?\s*?)+?$/";
        public static $phoneRegex = "/^\+\d{12}$/"; 
        public static $acceptedImages = ".jpg, .png, .bmp, .gif, .webp";
        const PRIME_NUMBER = 1879;
        /**
         * checks names to ensure that they meet policy
         */
        public static function checkName($name){
            if(preg_match(self::$nameRegex, $name)){
                return true;
            }
            return false;
        }

      
         /**
          * Checks to verify that the email meets the requirement
          */
         public static function checkEmail($email){
             if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                return true;
             }
             return false;
         }

          /**
           * Checks if the password is a qualified password
           * @return string|bool PNE|PLLE|PULE|PLSE
           * Password Number Error: Password must include numbers
           * Password Lowercase Letter Error: Password must include lowercase letters
           * Password Uppercase Letter Error: Password must include uppercase letters
           * Password Length Short Error: Password must length is shorter then 9 characters.
           */

           public static function isPasswordStrong($password){
            if(strlen($password) >= 9){
                if(preg_match('@[A-Z]@', $password)){
                   if(preg_match('@[a-z]@', $password)){
                      if(preg_match('@[0-9]@', $password)){
                        return true;
                      }
                      else{
                        return Response::makeResponse("PNE", "Password must have at least one digit");//Password Number Error
                      }
                   }else{
                     return Response::makeResponse("PLLE", "Password must have at least one lowercase letter");//Password Lowercase Letter Error
                   }
                }
                else{
                  return Response::makeResponse("PULE", "Password must have at least one uppercase letter");//Password Uppercase Letter Errors
                }
             }
             else{
               return Response::makeResponse("PLSE", "Password must be longer than 9 characters");//Password Length Short Error
             }
           }
    
        
            /**
             * Uploads a images to the server
             */
             public static function uploadImage(array $image, $save_name, $in_directory){
                $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
                $ext = strtolower($ext);

                switch (exif_imagetype($image['tmp_name'])) {
                    case IMAGETYPE_PNG:
                        $imageTmp=imagecreatefrompng($image['tmp_name']);
                        break;
                    case IMAGETYPE_JPEG:
                        $imageTmp=imagecreatefromjpeg($image['tmp_name']);
                        break;
                    case IMAGETYPE_GIF:
                        $imageTmp=imagecreatefromgif($image['tmp_name']);
                        break;
                    case IMAGETYPE_BMP:
                        $imageTmp=imagecreatefrombmp($image['tmp_name']);
                        break;
                    // Defaults to JPG
                    default:
                        $imageTmp=imagecreatefromjpeg($image['tmp_name']);
                        break;
                }
            
                // quality is a value from 0 (worst) to 100 (best)
                $name = $save_name.".jpeg";
                if(imagejpeg($imageTmp, "./../storage/$in_directory/$name", 70)){
                    imagedestroy($imageTmp);
                    
                    return $name;
                }
                else{
                    imagedestroy($imageTmp);
                    return false;
                }
            }

            /**
             * Checks if an image is in an acceptable format.
             * The extensions are .jpg, .jpeg, .png, .bmp, .webp 
             * @param string $path path to the image. Usually it is the tmp_name in the $_FILES
             * @return bool
             */
             public static function isImage($path){
                $check = exif_imagetype($path);
                if(in_array($check, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP, IMAGETYPE_WEBP))){
                    return true;
                }
                return false;
            }

              /**
               * For encryption of numbers that will be visible in a url.
               * For example, the confirm email link
               * @param int $number
               * @return string
               */
             public static function letoBase29Encode($number){
                $newNum = $number * Utility::PRIME_NUMBER;
                $newNum **= 2;
                $newNum = base_convert($newNum, 10, 29);
                $newNum = base64_encode($newNum);
                return $newNum;
            }

            /**
             * Decodes a letoBase29Encoded number.
             * @param string $input;
             * @return int;
             */
            public static function letoBase29Decode($input){
                $origNum = base64_decode($input);
                $origNum = base_convert($origNum, 29, 10);
                $origNum = sqrt($origNum);
                return $origNum/Utility::PRIME_NUMBER;
            }

            /**
             * Makes a six digit code
             */
            public static function make6digitCode(){
                $code = "";
                for($i = 0; $i < 6; $i++)
                {
                    $code .= random_int(1, 9);
                }

                return $code;
            }

            /**
             * this function returns date in a format  today @ xxx or yesterday @xxx or M, d y @ xxx where xxx is the exact time
             */

            public static function returnDate($timestamp) {
                if(is_string($timestamp)){
                    $timestamp = strtotime($timestamp);
                }
                $date = date('d/m/Y', $timestamp);

                if($date == date('d/m/Y')) {
                $date = 'Today';
                } 
                else if($date == date('d/m/Y',time() - (24 * 60 * 60))) {
                $date = 'Yesterday';
                }
                else{
                    $date = date("D,  M. d, Y ", $timestamp);
                }
                
                return "$date";
            }

    }

?>