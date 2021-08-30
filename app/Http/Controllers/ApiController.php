<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Devuelve los albumes de una banda o artista.
     *
     * @return Response
     */
    private function getToken()
    {
        $auth = base64_encode(env("SPOTIFY_CLIENT_ID") . ":" . env("SPOTIFY_CLIENT_SECRET"));
        $response = $this->client->post("https://accounts.spotify.com/api/token", [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ],
            'headers' => [
                'Authorization' => "Basic $auth"
            ]
        ]);
        $body = strval($response->getBody());
        return json_decode($body)->access_token;
    }

    public function albums(Request $request)
    {
        $token = $this->getToken();
        $q = $request->get('q');

        $response = $this->client->get("https://api.spotify.com/v1/search?q=$q&type=artist", ["headers" => ["Authorization" => "Bearer $token"]]);
        $artist = json_decode(strval($response->getBody()))->artists->items[0] ?? null;

        if ($artist) {
            $id = $artist->id;
            $artist_name = $artist->name;

            $albums_response = $this->client->get("https://api.spotify.com/v1/artists/$id/albums", ["headers" => ["Authorization" => "Bearer $token"]]);
            $albums = json_decode(strval($albums_response->getBody()), true)["items"];

            return view('albums', ['albums' => $albums, 'artist_name' => $artist_name]);
        } else {
            return "No se encontró un artista con ese nombre";
        }
    }
}
