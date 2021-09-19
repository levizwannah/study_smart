<?php
    /**
     * Please send every data with the post request.
     * That is, all fields must be included.
     * first-name, last-name, email, phone, and profile-image.
     * the profile-image will be empty if not image was sent.
     */
    
    require("master.inc.php");

    if(!$isLoggedIn){exit(Response::NLIE());}

    $user = new User();

    $user->loadUser($userId);

    $message = "";

    $updateSqlStr = "";
    $newValues = [];

    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];

    if(!empty($firstName) && $firstName != $user->getFirstName()){
        if(!Utility::checkName($firstName)){
            exit(Response::UNE());
        }

        $updateSqlStr .= "firstname = ?";
        $newValues[] = $firstName;
    }

    if(!empty($lastName) && $lastName != $user->getLastName()){
        if(!Utility::checkName($firstName)){
            exit(Response::UNE());
        }

        if(count($newValues) > 0){
            $updateSqlStr .= ", ";
        }

        $updateSqlStr .= "lastname = ?";
        $newValues[] = $lastName;
    }

    
   
    if(count($_FILES) > 0 && isset($_FILES['profile-image'])){
        $profileImage = $_FILES['profile-image'];
        if(!Utility::isImage($profileImage['tmp_name'])){
            exit(Response::IIE());
        }

        $updating = false;
        $oldProfileImage = "";
        if($user->getProfileImage() != User::DEFAULT_AVATAR){
            $updating = true;
            $oldProfileImage = $user->getProfileImage();
        }

        $newProfileImage = Utility::uploadImage($profileImage, $user->getId(), User::PROFILE_IMG_PATH, $updating, $oldProfileImage);

        if($newProfileImage !== false){
            if(count($newValues) > 0){
                $updateSqlStr .= ", ";
            }
    
            $updateSqlStr .= "profile_image = ?";
            $newValues[] = $newProfileImage;

        }else{
            $message .= " An error occurred while uploading your profile picture. ";
        }
    }

    $email = $_POST['email'];

    $dbManager = new DbManager();

    if(!empty($email) && $email != $user->getEmail()){
        if(!Utility::checkEmail($email)){
            exit(Response::UEE());
        }

        if(User::doesEmailExist($email, $dbManager)){
            exit(Response::EEE());
        }

        $dbManager->delete("temporary_email", "userId = ?", [$user->getId()]);

        if($dbManager->insert("temporary_email", ["userId, email"], [$user->getId(), $email]) != -1
         && User::sendConfirmationEmail($user->getId(), $email, $dbManager)
         ){
            $message .= "We have sent a confirmation email to $email. ";
        }
    }

    if(!(empty($updateSqlStr) || $dbManager->update("user", $updateSqlStr, $newValues, "id = ?", [$user->getId()]))){
        exit(Response::SQE());
    }

    $user->refresh();
    $response = json_encode([
        "token" => "$userId-$token",
        "firstname" => $user->getFirstName(),
        "lastname" => $user->getLastName(),
        "email" => $user->getEmail(),
        "profileImage" => User::PROFILE_IMG_PATH."/". $user->getProfileImage(),
        "message" => $message
    ]);
    exit(Response::makeResponse("OK", $response));

    

?>