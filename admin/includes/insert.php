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
include_once("../includes/process.php");
if (!isset($_SESSION['email'])) {
    header('Location: ../login.php');
} else {
    if (!isset($_POST['oculto'])) {
        exit();
    }
    include_once("../../includes/connection.php");
    include_once("../../includes/functions.php");
    $username = htmlspecialchars($_POST['txtusername']);
    $email = htmlspecialchars($_POST['txtemail']);
    $password = htmlspecialchars($_POST['txtpassword']);
    $repitpassword = htmlspecialchars($_POST['repitpassword']);
    $encpass = hash("sha3-512", $password);
    $rank = "";
    $time = date('H:i:s');
    $date = date('d/m/Y');
    $token_email = randomtoken();
    $status_email = "";
    $ip = $_SERVER['REMOTE_ADDR'];
    if ($username == '' || $email == '' || $password == '' || $repitpassword == '') {
        echo "<script>Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'There can no be space in blanks'
      })</script>";
        return;
    }elseif($password != $repitpassword){
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'The two password do not match'
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
    } else {
        $query = $con->prepare("
        INSERT INTO users (username, email, password, rank, time, date, ip, token_email, status_email) VALUES (:username, :email, :password, :rank, :time, :date, :ip, :token_email, :status_email)
        ");
        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":password", $encpass, PDO::PARAM_STR);
        $query->bindParam(":rank", $rank, PDO::PARAM_STR);
        $query->bindParam(":time", $time, PDO::PARAM_STR);
        $query->bindParam(":date", $date, PDO::PARAM_STR);
        $query->bindParam(":ip", $ip, PDO::PARAM_STR);
        $query->bindParam(":token_email", $token_email, PDO::PARAM_STR);
        $query->bindParam(":status_email", $status_email, PDO::PARAM_INT);

        $result = $query->execute();

        if ($result === TRUE) {
            header('Location: ../tables.php');
            echo "<script>alert(Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'You have successfully added an user',
            showConfirmButton: false,
            timer: 2000
        }))</script>";
        } else {
            echo "Error";
        }
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
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>