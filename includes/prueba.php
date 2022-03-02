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

$query = $con->query("SELECT * FROM users WHERE id AND status_email = '0'");
$result = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>STATUS EMAIL</td>
        <tr>
        <?php
        foreach ($result as $data) {
        ?>
        <tr>
          <th><?php echo "<b>$data->id</b>"; ?></th>
          <th><?php echo "<b>$data->username</b>"; ?></th>
          <th><?php echo "<b>$data->status_email</b>"; ?></th>
        </tr>
    </table>
    <?php
        }
    ?>
</body>
</html>