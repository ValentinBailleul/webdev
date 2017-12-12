<?php

/**
 * Created by PhpStorm.
 * User: b15010088
 * Date: 12/12/17
 * Time: 14:07
 */

ini_set("error_reporting", -1);
ini_set("display_error", "on");

class IndexController
{
    public function defaut() {

        require_once 'index.php';

        require_once 'Model/IndexModel.php';

    }
}