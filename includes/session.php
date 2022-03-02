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


include_once("config.php");
if (PHP_VERSION_ID < 70300) {
  //OLD VERSION TO 7.3
  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
    //HTTPS
    session_set_cookie_params(3600, '/', $domain, true, true);
  } else {
    //HTTP
    session_set_cookie_params(3600, '/', $domain, true, true);
  }
} else {
  //Newer version support samesite
  if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
    //HTTPS
    session_set_cookie_params(3600, '/', $domain, true, true);
    ini_set('session.cookie_samesite', "Strict");
  } else {
    //HTTP
    session_set_cookie_params(3600, '/', $domain, true, true);
    ini_set('session.cookie_samesite', "Strict");
  }
}
session_start();
?>