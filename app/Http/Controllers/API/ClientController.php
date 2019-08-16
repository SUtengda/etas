<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;

class ClientController extends Controller
{
    public function getClients($PAR_ID){

        $clients = Client::where('PAR_UID', '=', $PAR_ID)->get();

        return response()->json($clients);
    }

    public function postNewClient(Request $request){
        $client = Client::updateOrCreate(['CLI_UID'=>$request->CLI_UID],$request->all());

        return response()->json($client);
    }

    public function deleteClient($id){
        $client = Client::findOrFail($id);
        if($client) $client->delete();
        else return response()->json(error);
        return response()->json(null);
    }
}
