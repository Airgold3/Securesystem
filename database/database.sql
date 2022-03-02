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

-- 
-- DATABASE FOR THE SECURESYSTEM
--

CREATE DATABASE IF NOT EXISTS securesystem;

USE securesystem;

-- ----------------------------------------------
-- ------------TABLE USERS-----------------------
-- ----------------------------------------------
CREATE TABLE `users`(
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `token_email` varchar(300) NOT NULL,
  `status_email` int(11) NOT NULL,
  primary key(id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

