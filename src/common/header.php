<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title><?php echo ucwords($this->route)." | ".TITLE;?></title>

        <link href="<?php echo URL;?>assets/css/primer.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo URL;?>assets/css/styles.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

    <div class="Layout">
        <div class="Layout-sidebar border p-3">
            <?php include "sidebar.php";?>
        </div>

        <div class="Layout-main border p-3">
            
        