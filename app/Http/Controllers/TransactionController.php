<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index() {
        // return Inertia::render('organizer');
    }

    public function createTransaction(Request $request, User $user) {
        $request->validate([
            
        ]);
    }
}
