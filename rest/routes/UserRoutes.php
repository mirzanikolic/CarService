<?php

Flight::route('GET /staging/users', function () {
    Flight::json(Flight::userService()->getAll());
});

Flight::route('GET /staging/users/@id', function ($id) {
    Flight::json(Flight::userService()->getById($id));
});

Flight::route('GET /staging/users/@firstName', function ($firstName) {
    Flight::json(Flight::userService()->getUserByFirstName($firstName));
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

?>
