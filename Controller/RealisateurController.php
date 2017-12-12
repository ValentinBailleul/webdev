<?php

/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 12/12/17
 * Time: 14:08
 */

ini_set("error_reporting", -1);
ini_set("display_error", "on");

class RealisateurController
{
    public function defaut() {

        require_once 'Model/ActeurModel.php';
        $photos = RealisateurModel::getAllDirectorsBio();
        $photoRL = RealisateurModel::getAllDirectorsFilmo();
        $acteurs = RealisateurModel::getAllDirectorsFetiche();
        $tabGet = [
                    'bio'=> $photos,
                    'filmo'=> $photoRL,
                    'acteurs' => $acteurs,
                  ];


        getBlock("View/realisateur.php", $tabGet);
    }
}