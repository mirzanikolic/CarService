<?php

Flight::route('GET /staging/cars', function () {
    Flight::json(Flight::carService()->getAll());
});

Flight::route('GET /staging/cars/user/@userId', function ($userId) {
    Flight::json(Flight::carService()->getCarsByUserId($userId));
});

Flight::route('GET /staging/cars/@id', function ($id) {
    Flight::json(Flight::carService()->getById($id));
});

Flight::route('POST /staging/cars', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::carService()->add($data));
});

Flight::route('PUT /staging/cars/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::carService()->update($id, $data);
    Flight::json(Flight::carService()->getById($id));
});

Flight::route('DELETE /staging/cars/@id', function ($id) {
    Flight::carService()->delete($id);
    Flight::json(["message" => "Car successfully deleted"]);
});

?>
