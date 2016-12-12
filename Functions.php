<?php

/**
* Created by PhpStorm.
* User: Haq
* Date: 8/12/2016
* Time: 2:22 PM
*/
include_once("Adb.php");

class Functions extends Adb{
    function Functons(){
    }

    function addUser($firstname,$lastname,$organization,$email,$number,$password){
        $strQuery="insert into users set
        Firstname='$firstname',
        Lastname='$lastname',
        Organization='$organization',
        Email='$email',
        Number=$number,
        Password='$password'";
        return $this->query($strQuery);
    }

    function addRating($usercode, $rating){
        $strQuery="insert into ratings set usercode='$usercode',rating=$rating";
        return $this->query($strQuery);
    }

    function getUsercode($email)
    {
        $strQuery = "select usercode from users where email='$email'";
        return $this->query($strQuery);
    }
    function deleteUser($usercode){
        $strQuery="delete from users where usercode=$usercode";
        return $this->query($strQuery);
    }

    function getUsers(){
       $strQuery="select *  from users";
       return $this->query($strQuery);
   }

}
?>