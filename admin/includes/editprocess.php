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
}else{
    if(!isset($_POST['oculto'])){
        header('Location: ../index.php');
    }

    include_once("../../includes/connection.php");
    $id2 = htmlspecialchars($_POST['id2']);
    $username2 = htmlspecialchars($_POST['txt2username']);
    $email2 = htmlspecialchars($_POST['txt2email']);
    $status_email2 = htmlspecialchars($_POST['txt2status_email']);
    $rank2 = htmlspecialchars($_POST['txt2rank']);

    $query = $con->prepare("
    UPDATE users SET username = :username, email = :email, status_email = :status_email, token_email = NULL, rank = :rank WHERE id = :id;
    ");
    $query->bindParam(":id", $id2);
    $query->bindParam(":username", $username2);
    $query->bindParam(":email", $email2);
    $query->bindParam(":status_email", $status_email2);
    $query->bindParam(":rank", $rank2);

    $result = $query->execute();

    if($result === TRUE){
        header('Location: ../tables.php');
    }else{
        echo "Error";
    }
}
?>        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function mysweetalert(title, description, typeError){
            Swal.fire(
                title,
                description,
                typeError
            );
        }
    </script>
