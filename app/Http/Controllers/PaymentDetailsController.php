<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use Illuminate\Http\Request;

class PaymentDetailsController extends Controller
{
    public function save(Request $request) {
        // return $request->all();
        // $request->validate(); 
        try {
            PaymentDetail::updateOrCreate(['user_id' => auth()->id()],[
                'user_id' => auth()->id(),
                'bank_name' => $request->bank_name,
                'bank_number' => $request->bank_number,
                'account_name' => $request->account_name,
                'paypal_info' => $request->paypal_info,
                'stripe_info' => $request->stripe_info,
                'mpesa_info' => $request->mpesa_info,
            ]);
            return back()->with('success', 'Saved successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return response([
                'error' => 'Something wrong',
                'message' => $th->getMessage()
            ]);
        } 
    }

    public function get() {
        return PaymentDetail::with('organizer')->where('user_id', auth()->id())->first();
    }

    public function delete_info($infoId) {
        $info = PaymentDetail::find($infoId);
        if($info) {
            $info->delete();
            return back()->with('success', 'Info deleted');
        }
        return back()->with('error', 'Opps Something wrong');
    }
}
