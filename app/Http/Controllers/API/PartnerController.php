<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\PartnerRequest;
use App\Http\Controllers\Controller;
use App\Models\Partners;

class PartnerController extends Controller
{

    /*
     |-------------------------------------------------------------------------------
     | Get All Partners
     |-------------------------------------------------------------------------------
     | URL:            /api/v1/partners
     | Controller:     API\PartnerController@getPartners
     | Method:         GET
     | Description:    Gets all of the partners in the application
    */
    public function getPartners(){
        $partners = Partners::all();
        return response()->json($partners);
    }

    public function getPartner($id){
        $partner = Partners::where('PAR_UID', '=', $id)->first();
        return response()->json($partner);
    }

    public function deletePartner($id){
        $partner = Partners::findOrFail($id);
        if($partner) $partner->delete();
        else return response()->json(error);
        return response()->json(null);
    }

    public function postNewPartner(PartnerRequest $request){

        $partner = new Partners;
        $partner->PAR_partner = $request->input('PAR_partner') ;
        $partner->PAR_contact = $request->input('PAR_contact');
        $partner->PAR_address = $request->input('PAR_address');
        $partner->PAR_telephone = $request->input('PAR_telephone');
        $partner->PAR_mobilePhone = $request->input('PAR_mobilePhone');
        $partner->PAR_email = $request->input('PAR_email');

        $partner->save();

        return response()->json($partner, 201);
    }

    public function updatePartner(PartnerRequest $request){

        $partner = Partners::findOrFail($request->input('PAR_UID'));
        $partner->PAR_partner = $request->input('PAR_partner') ;
        $partner->PAR_contact = $request->input('PAR_contact');
        $partner->PAR_address = $request->input('PAR_address');
        $partner->PAR_telephone = $request->input('PAR_telephone');
        $partner->PAR_mobilePhone = $request->input('PAR_mobilePhone');
        $partner->PAR_email = $request->input('PAR_email');

        $partner->save();

        return response()->json($partner, 202);
    }
}
