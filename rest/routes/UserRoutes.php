<?php

use Firebase\JWT\JWT;

Flight::route('GET /staging/users', function () {
    Flight::json(Flight::userService()->getAll());
});

Flight::route('GET /staging/users/@id', function ($id) {
    Flight::json(Flight::userService()->getById($id));
});

Flight::route('GET /staging/users/@firstName', function ($firstName) {
    Flight::json(Flight::userService()->getUserByFirstName($firstName));
});

Flight::route('GET /staging/users/@email', function ($email) {
    Flight::json(Flight::userService()->getUserByEmail($email));
});

Flight::route('POST /staging/users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add($data));
});

Flight::route('PUT /staging/users/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::userService()->update($id, $data);
    Flight::json(Flight::userService()->getById($id));
});

Flight::route('DELETE /staging/users/@id', function ($id) {
    Flight::userService()->delete($id);
    Flight::json(["message" => "User successfully deleted"]);
});

Flight::route('POST /staging/login', function() {
    $data = Flight::request()->data->getData();
    $user = Flight::userService()->getUserByEmail($data["email"]);

    $key = "kM6GHlqkAofCWH37737pltGEanvJ";

    if (isset($user['id'])){
        if($user['password'] == $data['password']){
            unset($user['password']);
            $jwt = JWT::encode($user, $key, 'HS256');
            Flight::json(['token' => $jwt]);
        } else {
            Flight::json(["message" => "Wrong password"], 404);
        }
    } else {
        Flight::json(["message" => "User doesn't exist"], 404);
    }
});

?>
