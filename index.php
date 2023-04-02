<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS, PATCH');
require 'vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=carservice','root',''));

Flight::route('GET /staging/users', function(){
   $users = Flight::db()->query('SELECT * FROM Users', PDO::FETCH_ASSOC)->fetchAll();
   var_dump($users);
   Flight::json($users);
   });

Flight::start();

?>
