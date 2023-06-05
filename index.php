<?php
defined('DS') OR define('DS',DIRECTORY_SEPARATOR);

$errors=array();

if(!empty($errors)){

    echo "<h1>Errors:</h1><ol>";
    foreach($errors as $error){

        echo "<li>".$error."</li>";

    }
    echo "</ol>";

}
else{

    echo "application here.";

}
