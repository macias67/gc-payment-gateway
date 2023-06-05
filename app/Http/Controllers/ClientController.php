<?php

namespace App\Http\Controllers;

use App\Repositories\ClienteRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function get(Request $request, ClienteRepository $clienteRepository): JsonResponse
    {
        $id = $request->get('idp', 0);

        $cliente = $clienteRepository->findById($id);

        return response()->json([
            'message' => 'Client information',
            'client' => ($cliente === null) ? [] : $cliente->toArray()
        ], Response::HTTP_OK);
    }
}
