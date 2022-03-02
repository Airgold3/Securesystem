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


include_once("includes/connection.php");
include_once("includes/config.php");
include_once("includes/session.php");
if(!empty($_GET['token_email']) && isset($_GET['token_email']) && ($_SERVER['REQUEST_METHOD'] == 'GET')){
    $token_email = $_GET['token_email'];

    $query = $con->prepare("
    SELECT * FROM users WHERE token_email = :token_email AND status_email = 0 
    ");
    $query->bindParam(":token_email", $token_email, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch();

    $id = $row['id'];
    
    if (!empty($row)){
        $query2 = $con->prepare("
        UPDATE users SET status_email = 1, token_email = NULL WHERE id = :id
        ");
        $query2->bindParam(':id', $id, PDO::PARAM_INT);
        $query2->execute();
        $row2 = $query2->fetch();

        header('Location: login.php');
        echo "The account has been activated";
    }else{
        header('Location: login.php');
    }

}else{
    header('Location: login.php');
}

