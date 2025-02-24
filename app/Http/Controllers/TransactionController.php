<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Item::with('transactions')->where('user_id', Auth::user()->id)->whereHas('transactions')->orderBy('id', 'asc')->get();
        $items = Item::where('user_id', Auth::user()->id)->get();

        return view('dashboard.transaction.index', [
            'title' => 'Transactions'
        ], compact("items", "transactions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buy_amount' => 'required',
            'item' => 'required',
            'transaction_detail' => 'required'
        ]);

        $item = Item::where('id', $request->item)->first();

        if($request->buy_amount > $item->stock) {
            return back();
        }

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'buyer_name' => $request->buyer_name,
            'buy_amount' => $request->buy_amount,
            'transaction_amount' => $item->cost * $request->buy_amount,
            'transaction_detail' => $request->transaction_detail,
        ]);

        $item->update([
            'stock' => $item->stock - $request->buy_amount
        ]);

        $transaction->items()->attach($request->item);

        return back()->with('success_add', 'Data has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'buyer_name' => 'required',
            'buy_amount' => 'required',
            'transaction_detail' => 'required'
        ]);

        
        $item = Item::where('id', $request->item_id)->first();
        
        if(!$item) {
            return back();
        }

        if($request->buy_amount > $transaction->buy_amount) {
            $added_amount = $request->buy_amount - $transaction->buy_amount;
            if($added_amount > $item->stock) return back();
            $item->decrement('stock', $added_amount);
        } else if ($request->buy_amount < $transaction->buy_amount) {
            $added_stock = $transaction->buy_amount - $request->buy_amount;
            $item->increment('stock', $added_stock);
        }

        $transaction->update([
            'buyer_name' => $request->buyer_name,
            'buy_amount' => $request->buy_amount,
            'transaction_amount' => $request->buy_amount * $item->cost,
            'transaction_detail' => $request->transaction_detail
        ]);

        $transaction->items()->sync($request->item_id);

        return back()->with('success_edit', 'Data has been edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction, Request $request)
    {
        $item = Item::where('id', $request->item_id)->first();
        
        $last = $transaction->where('id', $request->transaction_id)->first();

        $item->increment('stock', $last->buy_amount);

        $transaction->delete();

        return back()->with('success_delete', 'Data has been deleted');
    }
}
