<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'ticket'])
            ->orderBy('createdAt', 'desc')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        if (!auth()->user()->is_admin && $transaction->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('transactions.show', compact('transaction'));
    }

    public function myTransactions()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->with(['ticket'])
            ->latest()
            ->paginate(10);
            
        return view('transactions.my-transactions', compact('transactions'));
    }
} 