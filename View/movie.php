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
    <?php getBlock("./php/header.php"); ?>
    <?php
    foreach ($films as $film){
        getBlock("./infoFilm.php", $film);
    }
    ?>
    <?php

    ?>

</article>
<aside>
    <h2>Réalisateur</h2>
    <?php
    $queryPhoto = "SELECT * FROM photo JOIN personne_has_photo ON photo.id = personne_has_photo.id_photo JOIN film_has_personne ON personne_has_photo.id_personne = film_has_personne.id_personne WHERE film_has_personne.id_film =".$id." AND film_has_personne.role = 'realisateur'";
    $stmt = mysqli_prepare($dbLink, $queryPhoto)
    or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($dbLink));
    $result = mysqli_stmt_get_result($stmt);
    print_r($result);
    if (mysqli_num_rows($result) != 0) {
        while ($photoR = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            getBlock("./php/Arealisateur.php", $photoR);
        }
    } else {
        echo 'Pas de résultats';
    }
    ?>
    <?php

    $queryRealisateur = "SELECT * FROM personne JOIN film_has_personne ON personne.id = film_has_personne.id_personne  WHERE film_has_personne.id_film =".$id." AND film_has_personne.role = 'realisateur'";
    $requeteR = mysqli_query($dbLink ,$queryRealisateur);
    $result = mysqli_fetch_assoc($requeteR);
    ?>
    <form action = "../php/rechercheRealisateur.php" method ="post">
        <input type = "text" name = "listeRealisateur" value = "<?php echo $result['id']  ?>" hidden>
        <button type = "submit">En savoir plus</button>
    </form>

    <h2>Acteurs</h2>
    <?php
    $queryPhoto2 = "SELECT * FROM photo JOIN personne_has_photo ON photo.id = personne_has_photo.id_photo JOIN film_has_personne ON personne_has_photo.id_personne = film_has_personne.id_personne WHERE film_has_personne.id_film =".$id." AND film_has_personne.role = 'acteur'";
    $stmt = mysqli_prepare($dbLink, $queryPhoto2)
    or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
    mysqli_stmt_execute($stmt)
    or die('Erreur dans la requête : ' . mysqli_error($dbLink));
    $result = mysqli_stmt_get_result($stmt);
    $acteurs = [];
    if (mysqli_num_rows($result) != 0) {
        while ($acteur = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            $acteurs[] = $acteur;
        }
    } else {
        echo 'Pas de résultats';
    }
    foreach ($acteurs as $acteur){
        getBlock("./php/Aacteur.php", $acteur);
    }
    ?>
    <?php

    $queryRealisateur = "SELECT * FROM personne JOIN film_has_personne ON personne.id = film_has_personne.id_personne  WHERE film_has_personne.id_film =".$id." AND film_has_personne.role = 'acteur'";
    $requeteR = mysqli_query($dbLink ,$queryRealisateur);
    while($result = mysqli_fetch_assoc($requeteR)){
    ?>

    <form action = "../php/rechercheActeur.php" method ="post">
        <input type = "text" name = "listeActeur" value = "<?php echo $result['id']  ?>" hidden>
        <button type = "submit">En savoir plus</button>
    </form>
    <?php
    }
    ?>
</aside>
</body>
<footer></footer>
</html>


