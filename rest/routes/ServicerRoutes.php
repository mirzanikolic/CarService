<?php

Flight::route('GET /staging/servicers', function () {
    Flight::json(Flight::servicerService()->getAll());
});

Flight::route('GET /staging/servicers/@id', function ($id) {
    Flight::json(Flight::servicerService()->getById($id));
});

Flight::route('POST /staging/servicers', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::servicerService()->add($data));
});

Flight::route('PUT /staging/servicers/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::servicerService()->update($id, $data);
    Flight::json(Flight::servicerService()->getById($id));
});

Flight::route('DELETE /staging/servicers/@id', function ($id) {
    Flight::servicerService()->delete($id);
    Flight::json(["message" => "Servicer successfully deleted"]);
});

?>
