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
    public static function defaut() {

        require_once 'Model/MovieModel.php'; //Controle de CreerCompte dans Model

        $films = MovieModel::getAllMoviesInfo();
        $photoRL = MovieModel::getAllMoviesImageL();
        $photo = MovieModel::getAllMoviesRealisateur();
        $acteurs = MovieModel::getAllMoviesActeur();
        $tabGet = [
            'info'=> $films,
            'imageL'=> $photoRL,
            'realisateur' => $photo,
            'acteur' => $acteurs,
        ];

        getBlock("View/movie.php", $tabGet);

    }
}