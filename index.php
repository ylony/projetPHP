<?php

namespace App;

use App\Includes\Autoloader;
use App\Controller\FrontController;

require_once "./includes/config.php";
require_once "./includes/Autoloader.php";

Autoloader::register();

$app = new FrontController();

	
