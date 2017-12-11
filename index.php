<?php

ini_set('error_reporting', '-1'); // '-1' : toutes les erreurs possibles
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('error_log', '/path/to/log/php.log');

include('php/fonction.php');

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
<?php //include "./php/header.php";?>

<article>
    <?php $queryPhoto = "SELECT * FROM film ";
    $stmt = mysqli_prepare($dbLink, $queryPhoto)
    or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($dbLink));
    $result = mysqli_stmt_get_result($stmt);
    ?>
    <form action = "./php/rechercheFilm.php" id ="rechercheFilm" method ="post">
        <select name = "listeFilm">
            <?php
            $query = mysqli_query($dbLink, $queryPhoto);
            while ($result = mysqli_fetch_assoc($query)){
            echo '<option value="'.$result['id'].'">'.$result["titre"].'</option>';
            }
            $requete2 = "SELECT * FROM film WHERE id =".$result['id'];
            #$testId = mysqli_num_rows($stmt);
            #if($testId == 0){
            #    getBlock("./index.php");
            #}
            ?>
        </select>
        <button type = "submit">Rechercher</button>
    </form>

</article>
</body>
<footer></footer>
</html>



