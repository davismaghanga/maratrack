<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Admin/Products/Index',[
            'products'=>$products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia::render('Admin/Products/Create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        Product::create([
            'name'=>$validated['name'],
            'opening_stock'=> $validated['opening_stock'],
            'current_stock' => $validated['opening_stock']
        ]);
        return redirect()->route('products.index')->with('success','Product Saved Successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $transactions = Transaction::with(['product:id,name,current_stock','user:id,name'])
            ->where('product_id',$product->id)
            ->latest()
            ->get();
        return Inertia::render('Admin/Products/Show',[
            'transactions'=>$transactions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit',[
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        /** incoming request is valid, retrieving validated input */
        $validated = $request->validated();
        $product->update($validated);
        return redirect()->back()->with('success','Product Saved Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }


    /**
    Operator Methods
     **/
    public function stockView()
    {
        $products = Product::all();
        return Inertia::render('Operator/Close',[
            'products'=>$products
        ]);

    }

    public function closeStock()
    {
        $products = Product::all();
        foreach ($products as $product){
            //assign opening stock to be closing stock
            $product->closing_stock = $product->current_stock;
            $product->opening_stock = $product->closing_stock;
            $product->save();
        }

        return redirect()->back()->with('success','Stock closed successfully.');
    }

    public function reportStock(Request $request)
    {

        $transactions = Transaction::with(['product:id,name,current_stock','user:id,name'])
            ->where('product_id',$request->productId)
            ->whereBetween('created_at',[$request->startDate,$request->endDate])
            ->where('type',$request->type)
            ->latest()
            ->get();
        return Inertia::render('Admin/Products/Report',[
            'transactions'=>$transactions
        ]);

    }


}
