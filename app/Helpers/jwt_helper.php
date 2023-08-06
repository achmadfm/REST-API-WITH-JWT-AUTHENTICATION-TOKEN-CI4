<?php

use App\Models\ModelAuthentikasi;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($authHeader)
{
    if (is_null($authHeader)) {
        throw new Exception("Authentikasi JWT Gagal");
    }

    return explode(" ", $authHeader)[1];
}

function validateJWT($encodedToken)
{
    $key = getenv('JWT_SECRET_KEY');
    $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
    $modelAuthentikasi = new ModelAuthentikasi();

    $modelAuthentikasi->getEmail($decodedToken->email);
}

function createJWT($email)
{
    $waktuRequest = time();
    $waktuToken = getenv('JWT_TIME_TO_LIVE');
    $expired = $waktuRequest + $waktuToken;
    $key = getenv('JWT_SECRET_KEY');
    $payload = [
        'email' => $email,
        'iat' => $waktuRequest,
        'exp' => $expired
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}
