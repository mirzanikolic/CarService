<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/dao/UserDao.class.php';
require_once __DIR__.'/services/UserService.php';

Flight::register('userDao', 'UserDao');
Flight::register('userService', 'UserService');

require_once __DIR__ . '/routes/UserRoutes.php';

Flight::start();
?>
