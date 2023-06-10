<?php
defined('DS') || define('DS',DIRECTORY_SEPARATOR);

$files=array("vendor".DS."autoload.php","src".DS."config".DS."include.php");

$errors=array();

foreach($files as $file){

    if(file_exists($file)){

        include_once $file;

    }
    else{

        $errors[]="file not found: ".$file;

    }

}

if(!empty($errors)){

    echo "<h1>Error(s):</h1><ol>";
    foreach($errors as $error){

        echo "<li>".$error."</li>";

    }
    echo "</ol>";

}
else{

    $app=new \Ulizeko\Core\Ulizeko();

}
