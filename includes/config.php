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


    //Database 
    define('DB_HOST', 'localhost'); //Add your DB host
    define('DB_USER', 'root'); // Add your DB root
    define('DB_PASS', ''); //Add your DB pass
    define('DB_NAME', 'securesystem'); //Add your DB Name

    //Put your time zone https://www.php.net/manual/es/timezones.php
    define('DEFAULT_ZONE', date_default_timezone_set('Europe/Madrid'));

    // Detect your domain 
    define('DOMAIN', $_SERVER['SERVER_NAME']);

    // Put your smtp email 
    define('EMAIL_WEBSITE', 'example@gmail.com');

    // Put your smtp email 
    define('PASSWORD_EMAIL', '');

    $domain = DOMAIN;

    $email_website = EMAIL_WEBSITE;

    $password_email = PASSWORD_EMAIL;

    //0 ERRORS
    define('ERRORS', error_reporting(0));

?>