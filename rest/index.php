<?php

require 'vendor/autoload.php';

require_once __DIR__ . '/services/UserService.php';
Flight::register('userService', "UserService");

require_once __DIR__ . '/routes/UserRoutes.php';

Flight::route('GET /', function () {
    echo "CarService";
});

Flight::start();

?>
