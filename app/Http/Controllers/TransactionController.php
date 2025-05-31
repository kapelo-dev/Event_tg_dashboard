<?php

namespace App\Http\Controllers;

use App\Models\MobileMoneyTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = MobileMoneyTransaction::with(['user'])
            ->orderBy('createdAt', 'desc')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function show(MobileMoneyTransaction $transaction)
    {
        if (!auth()->user()->is_admin && $transaction->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('transactions.show', compact('transaction'));
    }

    public function myTransactions()
    {
        $transactions = MobileMoneyTransaction::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);
            
        return view('transactions.my-transactions', compact('transactions'));
    }
} 