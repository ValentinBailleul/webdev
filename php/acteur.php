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
    $idA = $_GET['idActeur'];
    $queryFilm = "SELECT * FROM personne JOIN film_has_personne ON personne.id = film_has_personne.id_personne WHERE film_has_personne.id_personne =".$idA." AND film_has_personne.role = 'acteur'";
    $stmt = mysqli_prepare($dbLink, $queryFilm)
    or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($dbLink));
    $result = mysqli_stmt_get_result($stmt);
    $photo = [];
    if (mysqli_num_rows($result) != 0) {
        while ($photo = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $queryActeur = "SELECT * FROM personne JOIN personne_has_photo ON personne.id = personne_has_photo.id_personne JOIN photo ON personne_has_photo.id_photo = photo.id WHERE personne_has_photo.id_personne = $photo[id]";
            $stmt2 = mysqli_prepare($dbLink, $queryActeur)
            or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
            mysqli_stmt_execute($stmt2)
            or die('Erreur dans la requête : ' . mysqli_error($dbLink));
            $result2 = mysqli_stmt_get_result($stmt2);
            if (mysqli_num_rows($result2) != 0) {
                while ($AouR = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                    $photo['photoRA'][] = $AouR;
                }
            }
            $photos[] = $photo;
        }
    } else {
        echo 'Pas de résultats';
    }
    foreach ($photos as $photo){
        getBlock("./biographie.php", $photo);
    }
    ?>
</article>
</body>
<footer></footer>
</html>