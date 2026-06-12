<?php

namespace App\services;

class jwtService
{

    public static function generatorToken($user)
    {

        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);


        $payload = json_encode([
            'sub' => $user->id,
            'name' => $user->name,
            'iat' => time(),
            'exp' => time() + 3000
        ]);


        $base64urlHeader = self::base64URLEncode($header);
        $base64urlPayload = self::base64URLEncode($payload);

        $secret = env('APP_KEY');
        $signature = hash_hmac('sha256', $base64urlHeader . "." . $base64urlPayload, $secret, true);
        $base64urlSignature = self::base64URLEncode($signature);

    return $base64urlHeader . "." . $base64urlPayLoad . "." . $base64urlSignature;

    }


    
    
    public static function base64URLEnconde($data)
    {
        $b64 = base64_encode($data);

        if($b64 === false)
        {
            return false;
        }
        $url = strtr($b64, '+/', '-_'); //trocando os sinais da primeira string pela segunda
        return rtrim($url, '='); //removendo os =

    }

    }
