<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RecaptchaController extends Controller
{
    public function verifyRecaptcha(Request $request)
    {
        $token = $request->input('token');
        $secretKey = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'; // 将此处替换为你的 reCAPTCHA 秘密密钥

        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret' => $secretKey,
                'response' => $token
            ]
        ]);

        $body = json_decode((string) $response->getBody(), true);

        if ($body['success']) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => $body['error-codes']]);
        }
    }
}
