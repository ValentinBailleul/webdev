<?php
/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 05/12/17
 * Time: 09:24
 */
$id = $_POST['listeFilm'];
header("location: ../movie.php?idFilm=".$id);
