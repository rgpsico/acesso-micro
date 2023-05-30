<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gympass;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GympassController extends Controller
{

    protected $model;

    public function __construct(Gympass $Gympass)
    {
        $this->model = $Gympass;
    }

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

    public function alunos()
    {
        $model = new  Gympass();
        return $model->all();
    }

    public function chekinStore(Request $request)
    {

        $data = $request->all();



        ob_start();

        // Envie a resposta 200
        header('HTTP/1.1 200 OK');

        header('Content-Type: application/json');

        // Limpe e envie o buffer de saída
        ob_end_flush();
        flush();


        // Agora você pode continuar a execução do script
        $user = $this->model::where('email', $data['event_data']['user']['email'])
            ->orWhere('phone_number', $data['event_data']['user']['phone_number'])
            ->first();

        if ($user) {
            $atualizarGympass = $user->update(['gym_id' => $data['event_data']['gym']['id']]);
            return response()->json(['message' => 'Usuario ja eta cadastrado o gym_id foi atualizado'], 201);
        } else {
            // O usuário não existe, então crie um novo registro
            $checkin = $this->model::create([
                'unique_token' => $data['event_data']['user']['unique_token'],
                'event_type' => $data['event_type'],
                'first_name' => $data['event_data']['user']['first_name'],
                'last_name' => $data['event_data']['user']['last_name'],
                'email' => $data['event_data']['user']['email'],
                'phone_number' => $data['event_data']['user']['phone_number'],
                'lat' => $data['event_data']['location']['lat'],
                'lon' => $data['event_data']['location']['lon'],
                'gym_id' => $data['event_data']['gym']['id'],
                'gym_title' => $data['event_data']['gym']['title'],
                'product_id' => $data['event_data']['gym']['product']['id'],
                'product_description' => $data['event_data']['gym']['product']['description'],
                'timestamp' =>  $data['event_data']['timestamp'],
            ]);
        }



        if ($checkin) {
            return response()->json(['message' => 'Check-in criado com sucesso, Aluno foi cadastrado na base da academia '], 201);
        } else {
            return response()->json(['message' => 'Failed to store check-in.'], 500);
        }
    }
}
