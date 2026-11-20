<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Construyo la URL completa combinando la URL base de mi .env con el endpoint solicitado
    protected function apiUrl(string $endpoint = ''): string
    {
        $base = rtrim(env('URL_SERVER_API', 'http://127.0.0.1:8000/api/v1'), '/');
        return $base . '/' . ltrim($endpoint, '/');
    }

    // Realizo peticiones GET a la API y devuelvo el arreglo 'data'
    protected function apiGet(string $endpoint)
    {
        $response = Http::acceptJson()->timeout(10)->get($this->apiUrl($endpoint));

        if ($response->successful()) {
            return $response->json('data') ?? $response->json();
        }

        return null;
    }

    // Realizo peticiones POST, PUT o DELETE enviando JSON
    protected function apiWrite(string $method, string $endpoint, array $data = [])
    {
        $method = strtolower($method);
        return Http::acceptJson()->timeout(10)->{$method}($this->apiUrl($endpoint), $data);
    }

    // Realizo peticiones multipart/form-data para enviar archivos (fotografías de pacientes)
    protected function apiWriteMultipart(string $endpoint, array $data = [], $file = null, string $fileField = 'foto')
    {
        $request = Http::acceptJson()->timeout(15);

        if ($file) {
            $request = $request->attach(
                $fileField,
                file_get_contents($file->getRealPath()),
                $file->getClientOriginalName()
            );
        }

        return $request->post($this->apiUrl($endpoint), $data);
    }
}