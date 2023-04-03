<?php

require 'vendor/autoload.php';
require 'rest/dao/UserDao.class.php';

Flight::register('userDao', 'UserDao');

Flight::route('GET /staging/users', function() {
   Flight::json(Flight::userDao()->getUsers());
});

Flight::route('GET /staging/users/@id', function($id) {
   Flight::json(Flight::userDao()->getUserById($id));
});

Flight::route('POST /staging/users', function(){
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userDao()->addUser($data));
});

Flight::route('PUT /staging/users/@id', function($id) {
   $data = Flight::request()->data->getData();
   Flight::userDao()->updateUser($id, $data);
});

Flight::route('DELETE /staging/users/@id', function($id) {
   Flight::json(Flight::userDao()->deleteUser($id));
});

Flight::start();

?>
