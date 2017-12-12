<?php

ini_set('error_reporting', '-1'); // '-1' : toutes les erreurs possibles
ini_set('display_errors', 'on');
ini_set('log_errors', 'on');
ini_set('error_log', '/path/to/log/php.log');

include('../Model/fonction.php');

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
    <?php getBlock("./header.php"); ?>
    <?php
    foreach ($data as $film){
        getBlock("./infoFilm.php", $data['info']);
    }
    ?>
    <?php
        getBlock("./imageL.php", $data['imageL']);
    ?>

</article>
<aside>
    <h2>Réalisateur</h2>
    <?php
        getBlock("./Arealisateur.php", $data['realisateur']);
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
    foreach ($acteurs as $acteur) {
        getBlock("./Aacteur.php", $data['acteur']);
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


