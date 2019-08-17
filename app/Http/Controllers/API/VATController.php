<?php

namespace App\Http\Controllers\API;

use App\Models\Vats;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Client;

class VATController extends Controller
{
    public function getVATs(){

        $vats = Client::with(['vats'=>function($query){
            $date = Carbon::createFromFormat('Y-m-d',request()->month);
            $firstDayofMonth  = $date->startOfMonth()->toDateString();
            $lastDayofMonth = $date->endOfMonth()->toDateString();

            $query->whereBetween('vats.VAT_月份',[$firstDayofMonth,$lastDayofMonth]);
        }])
            ->where('clients.PAR_UID', '=', request()->PAR_UID)
            ->get(['clients.CLI_UID','clients.CLI_内部编号','clients.CLI_名称']);

        return response()->json($vats);
    }

    public function updateVats(Request $request){
        $vat = Vats::updateOrCreate(
            [
                'VAT_UID'=>$request->VAT_UID,
                'PAR_UID'=>$request->PAR_UID,
            ],
            $request->all()
        );

        return response()->json($vat);
    }

    public function deleteVat($id){
        $vat = Vats::findOrFail($id);
        if($vat) $vat->delete();
        else return response()->json(error);
        return response()->json(null);
    }
}
