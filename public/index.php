<?php

namespace App;

/**
 * @author Samir Ebrahim Hussein <samirhussein274@gmail.com>
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Africa/Cairo');

require_once '../vendor/autoload.php';

use App\Application;

$app = new Application($config);

$app->run();
