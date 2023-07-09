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

 /**
* @OA\Post(
*     path="/login", 
*     description="Login",
*     tags={"login"},
*     @OA\RequestBody(description="Login", required=true,
*       @OA\MediaType(mediaType="application/json",
*    			@OA\Schema(
*             @OA\Property(property="email", type="string", example="demo@gmail.com",	description="Student email" ),
*             @OA\Property(property="password", type="string", example="12345",	description="Password" ),
*        )
*     )),
*     @OA\Response(
*         response=200,
*         description="Logged in successfuly"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error"
*     )
* )
*/

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
