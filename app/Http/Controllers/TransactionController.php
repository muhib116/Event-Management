<?php

namespace App\Http\Controllers;

use App\Models\EventList;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index() {
        $query = Transaction::query();
        if (auth()->user()->type != 'admin') {
            $query->where('user_id', auth()->id());
        }
        $transactions = $query->get();
        return Inertia::render('OrganizerPay', [
            'transactions' => $transactions,
        ]);
    }

    public function createTransaction(EventList $eventList, User $user) {
        $total = 0;
        foreach ($eventList->tickets as $ticket) { 
            foreach ($ticket->ticket_sales as $sales) {
                $total += ($sales->price - $sales->commission) * $sales->quantity;
            }
        }
        $data = [
            'user_id' => $user->id,
            'amount' => $total,
            // 'note' => '',
            'event_list_id' => $eventList->id,
            'bank_name' => $user->payment_details->bank_name,
            'bank_number' => $user->payment_details->bank_number,
            'account_name' => $user->payment_details->account_name,
            'paypal_info' => $user->payment_details->paypal_info,
            'stripe_info' => $user->payment_details->stripe_info,
            'mpesa_info' => $user->payment_details->mpesa_info,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => 'paid',
            // 'settings'  => '',
        ];
        if ($eventList->transaction) {
            return back()->with('error', 'Already paid');
        }
        Transaction::create($data);
        return back()->with('success', 'Payment Created Successfully');
    }
}
