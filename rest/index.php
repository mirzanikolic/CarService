<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/dao/UserDao.class.php';
require_once __DIR__.'/services/UserService.php';
require_once __DIR__.'/dao/CarDao.class.php';
require_once __DIR__.'/services/CarService.php';
require_once __DIR__.'/dao/ServicerDao.class.php';
require_once __DIR__.'/services/ServicerService.php';

Flight::register('userDao', 'UserDao');
Flight::register('userService', 'UserService');

Flight::register('carDao', 'CarDao');
Flight::register('carService', 'CarService');

Flight::register('servicerDao', 'ServicerDao');
Flight::register('servicerService', 'ServicerService');

// middleware method for login
Flight::route('/*', function(){

    $key = "kM6GHlqkAofCWH37737pltGEanvJ";
    //return TRUE;
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/staging/login' || $path == '/docs.json' || $path == '/staging/servicers/register' || $path == '/staging/users/register') return TRUE; // exclude login route from middleware 
    $headers = getallheaders();
    if (@!$headers['Authorization']){
      Flight::json(["message" => "Authorization is missing"], 403);
      return FALSE;
    }else{
      try {
        $decoded = (array)JWT::decode($headers['Authorization'], new Key($key, 'HS256'));
        Flight::set('user', $decoded);
        return TRUE;
      } catch (\Exception $e) {
        Flight::json(["message" => "Authorization token is not valid"], 403);
        return FALSE;
      }
    }
  });

require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/CarRoutes.php';
require_once __DIR__ . '/routes/ServicerRoutes.php';

Flight::start();
?>
