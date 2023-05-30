<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GympassController extends Controller
{

    public function validateAccess(Request $request)
    {

        $gympassId = $request->gympass_id;

        $client = new Client(['base_uri' => 'https://sandbox.partners.gympass.com/access/v1/']);

        try {
            $response = $client->request('POST', 'validate', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer testkey',
                    'X-Gym-Id' => '1234'
                ],
                'json' => [
                    'gympass_id' => $gympassId
                ]
            ]);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody();

            // Decodificar o JSON para um array associativo
            $data = json_decode($content, true);


            if ($statusCode == 200) {
                // Trate a resposta bem-sucedida aqui
                $gympass_id = $data['results']['user']['gympass_id'];
                // ...
                return response()->json($data, 200);
            } elseif ($statusCode == 404) {
                // Trate o erro "Not Found" aqui
                $error_message = $data['errors'][0]['message'];
                // ...
                return response()->json(['error' => $error_message], 404);
            } elseif ($statusCode == 400) {
                // Trate o erro "Bad Request" aqui
                $error_message = $data['errors'][0]['message'];
                // ...
                return response()->json(['error' => $error_message], 400);
            } else {
                // Trate outros erros aqui
                return response()->json(['error' => 'Unexpected error'], $statusCode);
            }
        } catch (\Exception $e) {
            // Trate exceções aqui
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
