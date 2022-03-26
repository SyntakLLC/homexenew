<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Clients/Index', [
            'clients' => Client::where('user_name', auth()->user()->name)
                ->get()
                ->sortByDesc('created_at')
                ->values(),
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

    public function update(Request $request, Client $client)
    {
        $client->name = $request->name;
        $client->phone = $request->phoneNumber;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->client_type = $request->clientType;
        $client->sales_price = $request->salesPrice;
        $client->address = $request->address;
        $client->closing_date = $request->closingDate;
        $client->capped = $request->capped;
        $client->gci = $request->gci;
        $client->save();
    }

    public function mobileUpdate(Request $request)
    {
        $client = Client::find($request->clientId);
        $client->name = $request->name;
        $client->phone = $request->phoneNumber;
        $client->email = $request->email;
        $client->status = $request->status;
        $client->client_type = $request->clientType;
        $client->sales_price = $request->salesPrice;
        $client->address = $request->address;
        $client->closing_date = $request->closingDate;
        $client->capped = $request->capped;
        $client->gci = $request->gci;
        //
        $client->save();
    }

    public function store(Request $request)
    {
        $client = Client::create([
            'user_id' => auth()->user()->id,
            'user_name' => auth()->user()->name,
            'name' => $request->name,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'status' => $request->status,
            'client_type' => $request->clientType,
            'gci' => $request->gci,
        ]);

        return Redirect::route('client.index');
    }

    public function mobileStore(Request $request)
    {
        $client = Client::create([
            'user_id' => 1,
            'user_name' => $request->user_name,
            'name' => $request->name,
            'phone' => $request->phoneNumber,
            'email' => $request->email,
            'status' => $request->status,
            'client_type' => $request->clientType,
            'sales_price' => $request->salesPrice,
            'address' => $request->address,
            'closing_date' => $request->closingDate,
            'capped' => $request->capped,
            'gci' => $request->gci,
        ]);
    }

    public function get(Request $request)
    {
        $users = User::all();
        $array = [];

        foreach ($users as &$user) {
            $to_add = Client::where('user_name', $user->name)->get();
            $array = [...$array, $user->name => $to_add];
        }

        return $array;
    }

    public function updateClient(Request $request)
    {
        // dd('fhfhfhf');
        //         $client = Client::find($request->clientId);
        //
        //         $client->name = $request->name;
        //         $client->phone = $request->phone;
        //         $client->email = $request->email;
        //         $client->status = $request->status;
        //         $client->client_type = $request->clientType;
        //         $client->gci = $request->gci;
        //
        //         $client->save();

        return Redirect::route('client.index');
    }
}
