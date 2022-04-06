<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Auth;


class AuthController extends Controller
{
    public function start_login(Request $request) { 

        $state = Str::random(40);

        $request->session()->put('state', $state);
        $request->session()->put('client_id', $request->client_id);
        $request->session()->put('client_secret', $request->client_secret);
        $request->session()->put('redirect_uri', $request->redirect_uri);
    
        $query_url = http_build_query([
            'client_id' => $request->client_id,
            'redirect_uri' => $request->redirect_uri,
            'response_type' => 'code',
            'scope' => '',
            'state' => $state
        ]);
    
        return redirect(env('API_URL').'oauth/authorize?'.$query_url);
    }

    public function callback(Request $request) {

        $response = Http::post(env('API_URL').'oauth/token', [
            'grant_type' => 'authorization_code',
            'client_id' => $request->session()->get('client_id'),
            'client_secret' => $request->session()->get('client_secret'),
            'redirect_uri' => $request->session()->get('redirect_uri'),
            'code' => $request->code,
        ]);

        return view('home')->with('token', json_encode($response->json()) ) ;
    }
}
