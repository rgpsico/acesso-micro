<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HelpersMicro;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HelpersMicro;


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }



    public function auth(Request $request)
    {

        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            return auth()->user();
        }

        return response()->json(["data" => "Nome ou senha Errado"], 403);
    }

    public function authUrl($idweb, Request $request)
    {


     $url = 'https://vendas.mufitness.com.br/'.$idweb.'/auth';


    $data = array(
        'idweb' => $request->idweb,
        'nome' => $request->nome,
        'senha' => $request->senha
    );

    $client = new Client();

    try {
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode($data)
        ]);

        $responseData = json_decode($response->getBody(), true);

        if ($responseData['status'] === 'success') {

            $user = new User;

            $userExists = User::where('name', $data['nome'])->first();

            if(!$userExists) {
                $user->name = $request->nome;
                $user->password  = $this->encryptMicro($request->senha, 'VipService123', true);

                $user->save();


                auth()->login($user);


                return response(['content' => 'success', 200]);


            }else{
                auth()->login($userExists);
               return response(['content' => 'success', 200]);
            }

        } else {
            return response(['content' => 'não autorizado', 403]);
        }
    } catch (RequestException $e) {
        return response(['content' => 'não autorizado', 403]);

        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();

        }
    }
}
}
