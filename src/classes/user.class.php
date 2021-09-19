<?php
    require_once(__DIR__."/../interfaces/user.interface.php");
    require_once(__DIR__."/../traits/user.trait.php");

    class User implements UserInterface{
        use UserTrait;

        protected $firstName,
                $lastName,
                $email,
                $phone,
                $password,
                $id,
                $emailVerified,
                $type,
                $accountStatus,
                $evCode,
                $profileImage,
                $sessionId;

        const   USER_TABLE = "user",
                USER_ID = "`user`.`id`";

        public function __construct($id = 0){
            if($id == 0){
                return;
            }

            $this->loadUser($id);
        }

        /**
         * Loads a user from the database;
         * @param int $user_id
         */
        public function loadUser($user_id){
            $this->id = $user_id;
            $dbManager = new DbManager();
            $table = "user";
            $values = [$this->id];
            $userInfo = $dbManager->query($table, ["*"], "id = ?", $values);

            if($userInfo && count($userInfo) > 0){
                $this->setFirstName($userInfo['firstname']);
                $this->setLastName($userInfo['lastname']);
                $this->setEmail($userInfo['email']);
                $this->setPassword($userInfo['user_password']);
                $this->setPhone($userInfo['phone']);
                $this->setEmailVerified($userInfo['email_verified']);
                $this->setType($userInfo["user_type"]);
                $this->setProfileImage($userInfo["profile_image"]);
                $this->setEvCode($userInfo["ev_code"]);
                $this->setAccountStatus($userInfo["account_status"]);
                return true;
            }
            return false;
        }

        /**
         * Changes the user password when the user is logged in
         * @param string $oldPassword
         */
        public function changePassword($oldPassword, $newPassword){
            if(!$this->emailVerified){
                return Response::makeResponse("EVE", "Please verify your email before changing your password");
            }

            if(password_verify($oldPassword, $this->password)){
                 if(Utility::isPasswordStrong($newPassword) !== true){
                     return Utility::isPasswordStrong($newPassword);
                 }
                 $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                 $table = "user";
                 $values = [$newPassword];
                 $dbManager = new DbManager();
                 if($dbManager->update($table, "user_password = ?", $values, "id = ?", [$this->id])){
                     return Response::OK();
                 }
                 return Response::SQE();
            }
            return Response::WPE();
        }

        /**
         * Register a new user
         * the email and password must be set
         *  @return string 
         */
        public function register(){
            if($this->email == null){
                return Response::NEE(); //Null Email Error
            }
    
            if($this->password == null){
                return Response::NPE(); //Null Password Error
            }
    
            if(!Utility::checkEmail($this->email)){
                return Response::UEE();
            }
            $dbManager = new DbManager();

            if(User::doesEmailExist($this->email, $dbManager)){
                return Response::EEE();
            }
    
            if(Utility::isPasswordStrong($this->password) !== true){
                return Utility::isPasswordStrong($this->password); 
            }
    
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
     
            $tableName = "user";
            $column_specs = ["email","user_type", "account_status" , "user_password","profile_image"];
            $values = [$this->email,"rider", "enabled" , $this->password, User::DEFAULT_AVATAR];

            try{
                $insertId = $dbManager->insert($tableName, $column_specs, $values);
                if($insertId != -1){
                    $this->id = $insertId;
                    User::sendConfirmationEmail($this->id, $this->email, $dbManager);
                    $sessionToken = bin2hex(openssl_random_pseudo_bytes(255));
                    $dbManager->insert("session", ["userId", "session_token"], [$this->id, $sessionToken]);
                    //response
                    $response = json_encode([
                        "token" => "$this->id-$sessionToken",
                        "firstname" => "",
                        "lastname" => "",
                        "phone" => "",
                        "email"=>$this->email,
                        "profileImage" => User::DEFAULT_AVATAR,
                        "message" => "Successfully signed up"
                    ]);
                    return Response::makeResponse("OK", $response);
                }
            }
            catch(Exception $exception){}
            return Response::SQE();
        }

        //login
        public function login(){
            if(!isset($this->email) || empty($this->email)){
                return Response::NEE();
            }
    
            if(!isset($this->password) || empty($this->password)){
                return Response::NPE();
            }
    
            try{
                $tableName = "user";
                $columns = ["id", "firstname", "lastname","email", "phone","user_password", "profile_image"];
                $values = [$this->email];
                
                $dbManager = new DbManager();
                $details = $dbManager->query($tableName, $columns,"email = ?", $values);
                
                if($details !== false){
                    $hashed_password = $details['user_password'];
                    $userId = $details['id'];
    
                    if(!password_verify($this->password, $hashed_password)){
                        return Response::WPE();
                    }
                    $this->id = $userId;

                    //remove the old tokens
                    $sessionToken = bin2hex(openssl_random_pseudo_bytes(255));
                    if(
                        $dbManager->update("session", "session_token = ?", [$sessionToken], "userId = ?",[$this->id])
                        ){
                        
                            //response
                            $response = json_encode([
                                "token" => "$userId-$sessionToken",
                                "firstname" => $details["firstname"],
                                "lastname" => $details["lastname"],
                                "phone" => $details["phone"],
                                "email" => $details["email"],
                                "profileImage" => User::PROFILE_IMG_PATH."/". $details["profile_image"],
                                "message" => "Successfully logged in"
                            ]);
                        return Response::makeResponse("OK", $response);
                    }

                    return Response::SQE();
                }

                return Response::WEE();
            }
    
            catch (Exception $e){}
            return Response::SQE();
        }

        /**
         * Deletes the user session token
         */
        public function logout(){
            if(!isset($this->sessionId)){
                return Response::NLIE();
            }            

            if(!isset($this->id)){
                return Response::NIE();
            }
            
            $dbManager = new DbManager();
            if($dbManager->update("session", "session_token = ?", [""], "userId = ?",[$this->id])){
                return Response::OK();
            }

            return Response::SQE();
        }

        /**
         * A user forgot their password and wants a link to reset it.
         * The user email must be set.
         * @return string
         */
        public function forgotPassword(){
            if(empty($this->email) || $this->email == null){
                return Response::NEE();
            }

            $dbManager = new DbManager();
            $userInfo = $dbManager->query("user", ["id", "firstname", "lastname"], "email = ?", [$this->email]);

            if(!$userInfo || count($userInfo) < 1){
                return Response::CPETE();
            }

            $this->id = $userInfo['id'];
            $code = "";
            for($i = 0; $i < 6; $i++){
                $code .= random_int(1, 9);
            }
            $token = "$this->id-$code";
            
            $rowId = $dbManager->insert("reset_password", ["userId", "token"], [$this->id, $token]);
            if($rowId == -1){
                return Response::SQE();
            }

            $fullName = $userInfo["firstname"]." ". $userInfo["lastname"];
            if(empty($fullName))
            {
                $fullName = $this->email;
            }

            $sub = "Forgot Password";
            $msg = "Enter the code to change your password: $token";

           if(sendEmail($fullName, $this->email, $sub, $msg)){
               return Response::makeResponse("OK", "We have sent the code to change your password to $this->email");
           }
           return Response::UEO();
        }

        /**
         * Changes password from the forgotten password page.
         * @param string $code
         */
        public function setNewPassword($code){
            $token = $code;
            $id = explode("-", $code)[0];

            
            $dbManager = new DbManager();
            $result = $dbManager->query("reset_password", ["*"], "userId = ? and token = ?", [$id, $token]);
            if($result == false){
                return Response::CPTNFE();
            }

            //check expiry
            $dateSent = strtotime($result['created_on']);
            if(time() - $dateSent > (3600 * 24)){
                $dbManager->delete("reset_password", "token = ?", [$token]);
                return Response::CPETE();
            }

            //proceed to change password.
            if(empty($this->password) || $this->password == null){
                return Response::NPE();
            }

            if(Utility::isPasswordStrong($this->password) !== true){
                return Utility::isPasswordStrong($this->password);
            }

            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
            if($dbManager->update("user", "user_password = ?", [$this->password], "id = ?", [$result["userId"]])){
                $dbManager->delete("reset_password", "token = ?", [$token]);
                return Response::OK();
            }

            return Response::SQE();
        }

        /**
         * Deletes a user account
         */
        public function deleteAccount(){

        }

        public function confirmEmail($code){
            if(empty($this->id) || $this->id == null){
                return Response::NIE();
            }

            $dbManager = new DbManager();
            //check if there is an email in the temporary_email table. If there is, then that is what we are confirming.
            
           
            if($dbManager->update("user", "email_verified = ?, ev_code = 0", [1], "id = ? and ev_code = ?", [$this->id, $code]) === false){
                return Response::SQE();
            }

            if($dbManager->getAffRowsCount() < 1){
                return Response::makeResponse("WCE", "You entered an invalid code");
            }

            $temporaryEmail = $dbManager->query("temporary_email", ["email"], "userId = ?", [$this->id]);

            if($temporaryEmail !== false){

                if($dbManager->update("user", "email = ?", [$temporaryEmail["email"]], "id = ?", [$this->id]) === false){
                    return Response::SQE();
                }
            }

            return Response::OK();
        }

        public function confirmPhone($code){
            if(empty($this->id) || $this->id == null){
                return Response::NIE();
            }

            $dbManager = new DbManager();
            $temporaryPhone = $dbManager->query("temporary_phone_number", ["phone", "pv_code"], "userId = ?", [$this->id]);

            if($temporaryPhone === false){
                return Response::makeResponse("NPNFE", "You have verified the phone number attached to this account");
            }

            if($temporaryPhone["pv_code"] != $code){
                return Response::makeResponse("WCE", "You entered an invalid code");
            }

            if($dbManager->update("user", "phone = ?", [$temporaryPhone["phone"]], "id = ?", [$this->id]) === false){
                return Response::SQE();
            }

            if($dbManager->getAffRowsCount() < 1){
                return Response::UEO();   
            }
            
            $dbManager->delete("temporary_phone_number", "userId = ?", [$this->id]);
            return Response::OK();
                     
        }
        
        /**
         * Can the user upgrade to driver and admin?
         * This function checks that the minimum requirements are met.
         * @return bool
         */
        public function canUpgrade(){
            if(empty($this->firstName) ||
               empty($this->lastName) ||
               empty($this->phone) ||
               empty($this->email) ||
               empty($this->profileImage) ||
               !$this->emailVerified ||
               !file_exists("./../storage/profile_images/$this->profileImage")
               ){
                return false;
            }

            return true;
        }

        /**
         * Admin resets a password
         */
        public function adminResetPassword(){
            $randomPass = bin2hex(openssl_random_pseudo_bytes(9));
            $randomPass = password_hash($randomPass, PASSWORD_DEFAULT);

            $dbManager = new DbManager();
            return $dbManager->update(DbManager::USER_TABLE, "user_password = ?", [$randomPass], DbManager::USER_ID ."= ?", [$this->id]);
        }

        public function changeAccountStatus($status){
            $this->accountStatus = $status;
            $dbManager = new DbManager();
            return $dbManager->update(DbManager::USER_TABLE, "account_status = ?", [$this->accountStatus], DbManager::USER_ID ." = ?", [$this->id]);
        }

        /**
         * Gets the updated user details from the database
         */
        public function refresh(){
            $this->loadUser($this->id);
        }
        /**
         * Get the value of firstName
         */ 
        public function getFirstName()
        {
                return $this->firstName;
        }

        /**
         * Set the value of firstName
         *
         * @return  self
         */ 
        public function setFirstName($firstName)
        {
                $this->firstName = $firstName;

                return $this;
        }

        /**
         * Get the value of lastName
         */ 
        public function getLastName()
        {
                        return $this->lastName;
        }

        /**
         * Set the value of lastName
         *
         * @return  self
         */ 
        public function setLastName($lastName)
        {
                        $this->lastName = $lastName;

                        return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                        return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                        $this->email = $email;

                        return $this;
        }

        /**
         * Get the value of phone
         */ 
        public function getPhone()
        {
                        return $this->phone;
        }

        /**
         * Set the value of phone
         *
         * @return  self
         */ 
        public function setPhone($phone)
        {
                        $this->phone = $phone;

                        return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                        return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                        $this->password = $password;

                        return $this;
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
         * Get the value of emailVerified
         */ 
        public function getEmailVerified()
        {
                        return $this->emailVerified;
        }

        /**
         * Set the value of emailVerified
         *
         * @return  self
         */ 
        public function setEmailVerified($emailVerified)
        {
                        $this->emailVerified = $emailVerified == 1;

                        return $this;
        }

        /**
         * Get the value of type
         */ 
        public function getType()
        {
                        return $this->type;
        }

        /**
         * Set the value of type
         *
         * @return  self
         */ 
        public function setType($type)
        {
                        $this->type = $type;

                        return $this;
        }

        /**
         * Get the value of profileImage
         */ 
        public function getProfileImage()
        {
                        return $this->profileImage;
        }

        /**
         * Set the value of profileImage
         *
         * @return  self
         */ 
        public function setProfileImage($profileImage)
        {
                        $this->profileImage = $profileImage;

                        return $this;
        }

        /**
         * Get the value of evCode
         */ 
        public function getEvCode()
        {
                        return $this->evCode;
        }

        /**
         * Set the value of evCode
         *
         * @return  self
         */ 
        public function setEvCode($evCode)
        {
                        $this->evCode = $evCode;

                        return $this;
        }

        /**
         * Get the value of sessionId
         */ 
        public function getSessionId()
        {
                        return $this->sessionId;
        }

        /**
         * Set the value of sessionId
         *
         * @return  self
         */ 
        public function setSessionId($sessionId)
        {
                        $this->sessionId = $sessionId;

                        return $this;
        }

        /**
         * Get the value of accountStatus
         */ 
        public function getAccountStatus()
        {
                        return $this->accountStatus;
        }

        /**
         * Set the value of accountStatus
         *
         * @return  self
         */ 
        public function setAccountStatus($accountStatus)
        {
                        $this->accountStatus = $accountStatus;

                        return $this;
        }
    }

?>