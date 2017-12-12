<?php

/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 12/12/17
 * Time: 14:34
 */

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

class MovieModel
{
    public function getAllMoviesInfo ()
    {
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

        $id = $_GET['idFilm'];
        $queryFilm = "SELECT * FROM film WHERE id =".$id;
        $stmt = mysqli_prepare($dbLink, $queryFilm)
        or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
        mysqli_stmt_execute($stmt)
        or die('Erreur dans la requête : ' . mysqli_error($dbLink));
        $result = mysqli_stmt_get_result($stmt);
        $films = [];
        if (mysqli_num_rows($result) != 0) {
            while ($film = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $queryActeur = "SELECT * FROM personne JOIN film_has_personne ON personne.id = film_has_personne.id_personne WHERE film_has_personne.id_film = $film[id] AND role = 'acteur'";
                $stmt2 = mysqli_prepare($dbLink, $queryActeur)
                or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
                mysqli_stmt_execute($stmt2)
                or die('Erreur dans la requête : ' . mysqli_error($dbLink));
                $result2 = mysqli_stmt_get_result($stmt2);
                if (mysqli_num_rows($result2) != 0) {
                    while ($acteur = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                        $film['acteurs'][] = $acteur;
                    }
                }
                $films[] = $film;
            }
        } else {
            echo 'Pas de résultats';
        }

        return $films;
    }

    public function getAllMoviesImageL ()
    {
        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $queryPhoto = "SELECT * FROM photo JOIN film_has_photo ON photo.id = film_has_photo.id_photo WHERE role = 'gallerie' AND id_film =".$id;
        $stmt = mysqli_prepare($dbLink, $queryPhoto)
        or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
        mysqli_stmt_execute($stmt)
        or die('Erreur dans la requête : ' . mysqli_error($dbLink));
        $result = mysqli_stmt_get_result($stmt);
        $photoRL = [];
        if (mysqli_num_rows($result) != 0) {
            while ($photoR = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $photoRL[] = $photoR;
            }
        } else {
            echo 'Pas de résultats';
        }

        return $photoRL;
    }

    public function getAllMoviesRealisateur ()
    {
        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $queryPhoto = "SELECT * FROM photo JOIN personne_has_photo ON photo.id = personne_has_photo.id_photo JOIN film_has_personne ON personne_has_photo.id_personne = film_has_personne.id_personne WHERE film_has_personne.id_film =".$id." AND film_has_personne.role = 'realisateur'";
        $stmt = mysqli_prepare($dbLink, $queryPhoto)
        or die('Échec de paramétrage de la requête : ' . mysqli_error($dbLink));
        mysqli_stmt_execute($stmt)
        or die('Erreur dans la requête : ' . mysqli_error($dbLink));
        $result = mysqli_stmt_get_result($stmt);
        print_r($result);
        $photo = [];
        if (mysqli_num_rows($result) != 0) {
        while ($photoR = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $photo[] = $photoR;
        }
        } else {
            echo 'Pas de résultats';
        }
        return $photo;
    }

    public function getAllMoviesActeur()
    {
        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $queryPhoto2 = "SELECT * FROM photo JOIN personne_has_photo ON photo.id = personne_has_photo.id_photo JOIN film_has_personne ON personne_has_photo.id_personne = film_has_personne.id_personne WHERE film_has_personne.id_film =" . $id . " AND film_has_personne.role = 'acteur'";
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

        return $acteurs;
    }

}