<?php

interface UserInterface{
    const DEFAULT_AVATAR = "profile_imges/user-circle-solid.svg";
    const PROFILE_IMG_PATH = "profile_images";
    
    public function register();
    public function login();
    public function logout();
    public function deleteAccount();
}

?>