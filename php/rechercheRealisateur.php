<?php
/**
 * Created by PhpStorm.
 * User: Val
 * Date: 10/12/2017
 * Time: 18:05
 */

$idR = $_POST['listeRealisateur'];
header("location: realisateur.php?idRealisateur=".$idR);