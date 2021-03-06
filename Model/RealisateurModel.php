<?php

/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 12/12/17
 * Time: 14:34
 */

include('./fonction.php');

class RealisateurModel
{
    public function getAllDirectorsBio ()
    {
        ini_set('error_reporting', '-1'); // '-1' : toutes les erreurs possibles
        ini_set('display_errors', 'on');
        ini_set('log_errors', 'on');
        ini_set('error_log', '/path/to/log/php.log');

        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        mysqli_set_charset($dbLink, 'utf8');

        $idR = $_GET['idRealisateur'];
        $queryFilm = "SELECT * FROM personne JOIN film_has_personne ON personne.id = film_has_personne.id_personne WHERE film_has_personne.id_personne =".$idR." AND film_has_personne.role = 'realisateur'";
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
        return $photos;
    }

    public function getAllDirectorsFilmo ()
    {
        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        $queryPhoto = "SELECT * FROM photo JOIN film_has_photo ON photo.id = film_has_photo.id_photo WHERE id_film IN (SELECT id_film FROM film_has_personne WHERE role = 'realisateur' AND id_personne = $idR) AND role = 'poster'";
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

    public function getAllDirectorsFetiche (){
        $dbLink = mysqli_connect('mysql-webdev.alwaysdata.net', 'webdev_hercule', '04051997')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());

        mysqli_select_db($dbLink, 'webdev_hercule')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
        $idR = $_GET['idRealisateur'];
        $queryActeurFetiche = "SELECT COUNT(film_has_personne.id_personne), film_has_personne.id_personne, legende, chemin
                            FROM film_has_personne JOIN personne_has_photo ON film_has_personne.id_personne = personne_has_photo.id_personne JOIN photo ON personne_has_photo.id_photo = photo.id
                            WHERE film_has_personne.id_personne != " . $idR . "
                                AND film_has_personne.id_film IN 
                                (SELECT id_film FROM film_has_personne WHERE film_has_personne.id_personne = " . $idR . ")
                                 GROUP BY film_has_personne.id_personne
                                 LIMIT 2";
        $stmt = mysqli_prepare($dbLink, $queryActeurFetiche)
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