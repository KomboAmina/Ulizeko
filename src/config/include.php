<?php
/**
 * Includes all application config files, used for the system.
 */

$errors=(!isset($errors) && is_array($errors)) ?$errors:array();

$configFiles=array("basic.php","database.php");

foreach($configFiles as $configFile){

    $configFile="src".DS."config".DS.$configFile;

    if(file_exists($configFile)){

        include_once $configFile;

    }
    else{

        $errors[]="config file not found: ".$configFile;

    }

}
