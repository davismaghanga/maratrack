<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions =  Transaction::with(['product:id,name','user:id,name'])->get();
        return Inertia::render('Admin/Transactions/Index',[
            'transactions'=>$transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        return Inertia::render('Admin/Transactions/Create',[
            'products'=>$products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->product_id = $request['product_id'];
        $transaction->type = $request['type'];
        $transaction->quantity = $request['quantity'];
        $transaction->user_id = $request->user()->id;
        $transaction->save();


        $product = Product::find($request['product_id']);
        if ($request['type'] == 'restock'){
            $product->current_stock += $transaction->quantity;
            $product->restocked_qty = $product->restocked_qty + $transaction->quantity;
        }
        else{
            if ($product->current_stock < $transaction->quantity) {
                return redirect()->back()->withErrors(['error' => 'Insufficient stock.']);
            }
            $product->current_stock -= $transaction->quantity;
            $product->packaged_qty = $product->packaged_qty + $transaction->quantity;
        }
        $product->save();

        return redirect()->back()->with('success','Transaction Saved Successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return Inertia::render('Admin/Transactions/Show',[
            'transaction'=>$transaction,
            'product'=>Product::find($transaction->product_id),
            'operator'=>User::find($transaction->user_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return Inertia::render('Admin/Transactions/Edit',[
            'product_id'=>$transaction->product_id,
            'products'=>Product::all(),
            'transaction'=>$transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        $transaction->update();
        $product = Product::find($request['product_id']);
        if ($request['type'] == 'restock'){
            $product->current_stock += $transaction->quantity;
            $product->restocked_qty = $product->restocked_qty + $transaction->quantity;
        }
        else{
            if ($product->current_stock < $transaction->quantity) {
                return redirect()->back()->withErrors(['error' => 'Insufficient stock.']);
            }
            $product->current_stock -= $transaction->quantity;
            $product->packaged_qty += $request->packaged_qty;
        }
        $product->save();

        return redirect()->back()->with('success','Transaction Saved Successfully.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index');
    }

    public function restock()
    {
        $products = Product::all();
        $clients = Client::all();
        return Inertia::render('Operator/Restock-Package',[
            'products'=>$products,
            'clients'=>$clients
        ]);

    }


}
