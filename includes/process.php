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


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once("connection.php");
include_once("functions.php");
include_once("session.php");
include_once("config.php");
include_once("phpmailer/PHPMailer.php");
include_once("phpmailer/SMTP.php");
include_once("phpmailer/Exception.php");

// VARIABLES
$rank = "";
$time = date('H:i:s');
$date = date('d/m/Y');
$ip = get_user_ip($ipaddress);
$token_email = randomtoken();
$status_email = "";
$errors = array();

/******************************************/
/***IF USER CLICK SUBMIT REGISTER FORM*****/
/******************************************/
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['register_btn']) && isset($_POST['answer']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  $username = anti_xss($_POST['username']);
  $email = anti_xss($_POST['email']);
  $password = anti_xss($_POST['password']);
  $password2 = anti_xss($_POST['password2']);
  $encpass = hash("sha3-512", $password);
  $answer = $_SESSION["answer"];
  $user_answer = $_POST["answer"];
  if ($answer != $user_answer) {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Error Capcha'
      })</script>";
    return;
  }
  if ($password != $password2) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The two passwords do not match'
          })</script>";
    return;
  } elseif (strlen($password) <= 4 && strlen($password2) <= 4) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The password must be more than 5 letters'
          })</script>";
    return;
  } elseif ($username == "" || $email == "" || $password == "" || $password2 == "" || $answer == "") {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'There can be no space in blanks'
          })</script>";
    return;
  } elseif (!check_username_exist($con, $username)) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'User already exists'
          })</script>";
    return;
  } elseif (!check_email_exist($con, $email)) {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email already exists'
          })</script>";
    return;
  } elseif (!isGmail($con, $email)) {
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'We only accept safe emails like google, hotmail or yahoo. <br>Try again'
      })</script>";
    return;
  }
  /*elseif(!checkIp($con, $ip)){
            echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'You can only register with 1 IP. <br>Try again'
      })</script>";
        return;
    }*/
  if (registerusers($con, $username, $email, $encpass, $rank, $time, $date, $ip, $token_email, $status_email) && count($errors) == 0) {
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = 2;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $email_website;                     //SMTP username
        $mail->Password   = $password_email;                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients 
        $mail->setFrom('no-reply@yourdomain.com', 'Mailer');
        $mail->addAddress($email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Hello'. $email;
        $mail->Body    = 'You must verified your email here: ' . "$domain/checkemail.php?token_email=$token_email";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
      echo "<script>Swal.fire(
        'Good Job!',
        'You have been successfully registered, please verify your email for log in',
        'success'
      )</script>";
        header("Refresh:5; url=login.php", true, 303);
    }else{
      echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Error try again'
      })</script>";
      return;
    }
  }


if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['answer']) && isset($_POST['token']) && isset($_POST['login_btn']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  $answer = $_SESSION["answer"];
  $user_answer = $_POST["answer"];
  if ($answer != $user_answer) {
    echo "<script>Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Error Capcha'
    })</script>";
    return;
  }
  if ($_POST['token'] == $_SESSION['token']) {
      
  } else {
    echo "<script>Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Invalid token'
    })</script>";
    return;
  }

  $email = anti_xss($_POST['email']);
  $password = anti_xss($_POST['password']);
  $encpass = hash("sha3-512", $password);
  if ($email == "" || $password == "" || $answer == "") {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'There can no be spaces in white'
          })</script>";
    return;
  }

  if (signin($con, $email, $encpass)) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  }elseif(checkemailverified($con)){
    echo "<script>Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Verfied your email please'
    })</script>";
return;
  }else {
    echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The user or the password are incorrect. Please try again'
          })</script>";
    return;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</html>