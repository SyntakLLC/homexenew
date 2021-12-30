<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Clients/Index', [
            'clients' => Client::all(),
        ]);
    }

    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => $client,
        ]);
    }

    public function show(Client $client)
    {
        return Inertia::render('Clients/Show', [
            'client' => $client,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('Clients/Create');
    }

    public function updateClient(Request $request)
    {
        $client = Client::find($request->clientId);

        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->client_type = $request->clientType;
        $client->gci = $request->gci;

        $client->save();

        return Redirect::route('client.index');
    }

    public function createClient(Request $request)
    {
        $client = Client::create([
            'user_id' => $request->userId,
            'user_name' => $request->userName,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status,
            'client_type' => $request->clientType,
            'gci' => $request->gci,
        ]);

        return Redirect::route('client.index');
    }

    public function get(Request $request)
    {
        return Client::all();
    }
}
