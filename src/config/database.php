<?php

/**
 * Database setup constants, included in src\config\include.php
 * 
 * Create a MySQL Database.
 * Navigate to src\data\base.sql and either import or copy its contents to your MySQL server.
 * Copy the name of your database to the DBNAME constant in this file.
 * Copy the name of your MySQL user account to the DBUSER constant in this file.
 * Copy the password of your MySQL user account to the DBPASS constant in this file.
 * Change the port in DBPORT from 3306 if you have another one configured in your server.
 */

defined('DBHOST') || define('DBHOST','localhost');

defined('DBNAME') || define('DBNAME','ulizekodb');

defined('DBUSER') || define('DBUSER','root');

defined('DBPASS') || define('DBPASS','root');

defined('DBPORT') || define('DBPORT',3306);
