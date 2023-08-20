<?php
namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    static function CreateToken($userEmail, $userID): string
    {
        $key = env('JWT_KEY');
        $payload = [
            'iss' => 'laravel-token', // Issuer
            'iat' => time(), // Issued At
            'exp' => time() + 60 * 60, // Expire time
            'userEmail' => $userEmail, // User email
            'userID' => $userID, // User ID
        ];

        return JWT::encode($payload, $key, 'HS256');
    }

    static function VerifyToken($token): string | object
    {
        try {
            if ($token == null) {
                return 'Unauthorized';
            } else {
                $key = env('JWT_KEY');
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                return $decoded;
            }
        } catch (Exception $e) {
            return 'Unauthorized';
        }
    }
}
