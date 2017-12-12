<?php

/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 12/12/17
 * Time: 14:07
 */
ini_set("error_reporting", -1);
ini_set("display_error", "on");

class MovieController
{
    public function defaut() {

        require_once 'Model/MovieModel.php'; //Controle de CreerCompte dans Model

        require_once 'View/header.php';

        require_once 'View/imageL.php';

        require_once 'View/Arealisateur.php';

        require_once 'View/Aacteur.php';
    }
}