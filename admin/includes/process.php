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

include_once("../../includes/connection.php");
include_once("../../includes/functions.php");

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['loginadmin_btn']) && $_SERVER['REQUEST_METHOD'] === "POST") {
  $email = anti_xss($_POST['email']);
  $password = anti_xss($_POST['password']);
  $encpass = hash("sha3-512", $password);
  if ($email == "" || $password == "") {
    echo "<script>Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'There can no be spaces in white'
            })</script>";
    return;
  }

  if (signinadmin($con, $email, $encpass)) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } elseif(checkrank($con)){
    echo "<script>Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'You are not an admin. Please contact an admin to change your perms to 1'
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
<body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>