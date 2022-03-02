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


    $first_num = rand(1, 10);
    $second_num = rand(1, 10);
    
    $operators = array("+", "-", "*");
    $operator = rand(0, count($operators) - 1);
    $operator = $operators[$operator];
    
    $answer = 0;
    switch($operator) {
         case "+":
             $answer = $first_num + $second_num;
             break;
         case "-";
             $answer = $first_num - $second_num;
             break;
         case "*";
             $answer = $first_num * $second_num;
             break;
        
    }
 
    $_SESSION["answer"] = $answer;
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