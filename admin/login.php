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
include_once("../includes/functions.php");
if (isset($_SESSION['email'])) {
    header('Location: index.php');
}else{
  include_once("includes/process.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="master.css">
    <link rel="shurcot icon" href="img/logo.jpg">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
  </head>
  <body>

    <div class="login-box">
      <img src="https://avatars.githubusercontent.com/u/62146446?v=4 " class="avatar" alt="Avatar Image">
      <h1>Login Admin</h1>
      <form method="POST">
        <!-- USERNAME INPUT -->
        <label for="email">Email</label>
        <input type="email" placeholder="Enter Email" name="email" required> 
        <!-- PASSWORD INPUT -->
        <label for="password">Password</label>
        <input type="password" placeholder="Enter Password" name="password" required>
        <input type="submit" value="Log In" name="loginadmin_btn">
        <a href="../index.php">Go home</a>
      </form>
    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </body>
</html>
<?php
}

?>
