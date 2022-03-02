<?php

/*
This file is part of SecureSystem.
Copyright (C) 2022 Santiago Fernández, Airgold3 
    SecureSystem is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    SecureSystem is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with SecureSystem.  If not, see <https://www.gnu.org/licenses/>.
*/


include_once("connection.php");
include_once("config.php");
include_once("session.php");

/********************/
/****SIGNUP FORM*****/
/********************/
function registerusers($con, $username, $email, $encpass, $rank, $time, $date, $ip, $token_email, $status_email){
    $query = $con->prepare("
        INSERT INTO users (username, email, password, rank, time, date, ip, token_email, status_email) VALUES (:username, :email, :password, :rank, :time, :date, :ip, :token_email, :status_email);
    ");
    $query->bindParam(":username", $username, PDO::PARAM_STR);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->bindParam(":password", $encpass, PDO::PARAM_STR);
    $query->bindParam(":rank", $rank, PDO::PARAM_INT);
    $query->bindParam(":time", $time, PDO::PARAM_STR);
    $query->bindParam(":date", $date, PDO::PARAM_STR);
    $query->bindParam(":ip", $ip, PDO::PARAM_STR);
    $query->bindParam(":token_email", $token_email, PDO::PARAM_STR);
    $query->bindParam(":status_email", $status_email, PDO::PARAM_INT);

    return $query->execute();
}

/*****************/
/***LOGIN FORM***/
/****************/
function signin($con, $email, $encpass)
{
    $query = $con->prepare("
        SELECT * FROM users WHERE email = :email AND password = :password AND status_email = 1
    ");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->bindParam(":password", $encpass, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() == 1)
    {
        return true;
    }else{
        return false;
    }
}

/*****************/
/***LOGIN ADMIN***/
/****************/
function signinadmin($con, $email, $encpass)
{
    $query = $con->prepare("
        SELECT * FROM users WHERE email = :email AND password = :password AND rank = 1
    ");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->bindParam(":password", $encpass, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() == 1)
    {
        return true;
    }else{
        return false;
    }
}

/***********************/
/*CHECK USERNAME EXIST*/
/**********************/
function check_username_exist($con, $username){
    $query = $con->prepare("
        SELECT * FROM users WHERE username = :username
    ");
    $query->bindParam(":username", $username, PDO::PARAM_STR);
    $query->execute();

    // check
    if($query->rowCount() == 1)
    {
        return false;
    }else{
        return true;
    }
}


/***********************/
/**CHECK EMAIL EXIST***/
/**********************/
function check_email_exist($con, $email){
    $query = $con->prepare("
        SELECT * FROM users WHERE email = :email
    ");
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();

    // check
    if($query->rowCount() == 1)
    {
        return false;
    }else{
        return true;
    }
}


/***********************/
/****CHECK IP EXIST*****/
/**********************/
function check_ip_exist($con, $ip){
    $query = $con->prepare("
        SELECT * FROM users WHERE ip = :ip
    ");
    $query->bindParam(":ip", $ip, PDO::PARAM_STR);
    $query->execute();

    // check
    if($query->rowCount() == 1)
    {
        return false;
    }else{
        return true;
    }
}

function checkemailverified($con){
    $query = $con->query("SELECT * FROM users WHERE id AND status_email = '0'");
    return $result = $query->fetchAll(PDO::FETCH_OBJ);
}

function checkrank($con){
    $query = $con->query("SELECT * FROM users WHERE id AND rank = '0'");
    return $result = $query->fetchAll(PDO::FETCH_OBJ);
}

/*****************/
/**GET CLIENT IP**/
/*****************/
global $ipaddress;
function get_user_ip($ipaddress) {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/**********************/
/**RANDOM TOKEN**/
/********************/
function randomtoken($length = 100){
    bin2hex($length);
    $pass = '';
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = '';
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $n = mt_rand(0, $alphaLength);
       $pass .= $alphabet[$n];
   }
   return $pass;
}

/**********************/
/**ANTI XSS FUNCTION**/
/********************/
function anti_xss($data)    {
    $data = trim($data); // Eliminate white space
    $data = stripslashes($data); // Remove slashes from a string with escaped quotes
    $data = htmlspecialchars($data); // Convert special characters to HTML entities for preventing XSS Attack
    return $data;
}

/***************************/
/*********ONLY EMAIL*******/
/**************************/
function isGmail($con, $email) {
    $email = trim($email); // in case there is any blank space
    return mb_substr($email, -10) == '@gmail.com' || mb_substr($email, -12) == '@hotmail.com' || mb_substr($email, -10) == '@yahoo.com';
}

/*********************/
/***SQL FETCH DATA ***/
/*********************/
function fetchRecords($con)
{
    $query = $con->prepare("

    SELECT * FROM users 

    ");
    $query->execute();

    return $query->fetchAll();
}
$results = fetchRecords($con);


/*******************/
/***GEOLOCATE IP***/
/*******************/
function geolocate($ip){
    $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
    $city = $geo['geoplugin_city'];
    $country = $geo['geoplugin_countryName'];
    return "(" . $city . ") [" . $country . "]";
}

/***************************/
/***COUNTER OF USERS***/
/**************************/
global $user;
function totaluser($con, $user) {
    $user = $con->query("SELECT count(id) AS total FROM users WHERE rank = '0'")->fetchColumn();
    echo $user;
}

/***************************/
/***COUNTER OF ADMINS***/
/**************************/
global $admin;
function totaladmins($con, $admin) {
    $admin = $con->query("SELECT count(id) AS total FROM users WHERE rank = '1'")->fetchColumn();
    echo $admin;
}

/*******************************/
/***COUNTER OF PENDING EMAIL****/
/******************************/
global $emailnotverified;
function totalemailnotverified($con, $emailnotverified) {
    $emailnotverified = $con->query("SELECT count(id) AS total FROM users WHERE status_email = '0'")->fetchColumn();
    echo $emailnotverified;
}

function generatetoken(){
    return $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
}

function check($token){
    if(isset($_SESSION['token']) && $token === $_SESSION['token']){
        unset($_SESSION['token']);
        return true;
    }
    return false;
}