<?php

ini_set('error_reporting', '-1'); // '-1' : toutes les erreurs possibles
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('error_log', '/path/to/log/php.log');

include('./fonction.php');

$dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

mysqli_select_db($dbLink, 'webdev_hercule')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
mysqli_set_charset($dbLink, 'utf8');
?>
<!doctype html>
<html>
<head>
    <title>WebDev</title>
    <link rel="stylesheet" href="../css/index.css"/>
    <meta charset="utf-8">
</head>
<body>
<?php include "./header.php" ?>
<article>

    <?php
    //biographie
    foreach ($data as $photo){
        getBlock("./biographie.php", $photo);
    }
    ?>

    <h2>Filmographie</h2>
<?php
    //filmographie
    foreach ($data as $photoRL){
        getBlock("./filmographie.php", $photoRL);
    }
?>

    <h2>Acteurs fétiches</h2>
    <?php
    //fetiche
    foreach ($data as $acteur){
        getBlock("./acteurFetiche.php", $acteur);
    }
    ?>
        </article>
    </body>
    <footer></footer>
</html>