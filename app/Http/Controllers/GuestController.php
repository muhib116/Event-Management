<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guests;

class GuestController extends Controller
{
    public function getGuest($email)
    {
        $res = Guests::where("email", $email)->first();
        return $res;
    }

    public function createGuest(Request $request)
    {
        // return $request->all();
        $data = [
            "firstName" => $request->firstName,
            "lastName"  => $request->lastName,
            "email"     => $request->email,
            "phone"     => $request->phone,
            "settings"  => $request->settings,
            "ip_info"  => $request->ip_info,
        ];

        $isExist = Guests::where("email", $request->email)->exists();
        $res = false;
        if($isExist){
            $res = Guests::where("email", $request->email)->update($data);
        }else{
            $res = Guests::create($data);
        }


        if($res){
            return response()->json(['status' => true], 200);
        }
        return response()->json(['status' => false], 500);
    }
}
