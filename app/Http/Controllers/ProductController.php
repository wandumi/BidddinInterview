<?php

namespace App\Http\Controllers;


use auth;
use App\Bid;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // return Product::has('bids')->get();
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth::id();

        
        $this->validate($request, [
            'name' => 'required|string|unique:products,name',
            'sku' => 'required|string|unique:products,sku',
            'price' => 'required|integer',
            'description' => 'required'
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->user_id = $user;
        $product->save();
        
        // $product->user()->associate( auth::id() );

        return ['message', 'Product Successfully Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product->bids()->orderBy('price', 'asc')->get();
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = Product::findOrFail($product);

        // return $request->all();
        $this->validate($request,[
            'name' => 'required|string|unique:products,name,'.$product->id,
            'sku' => 'required|string|unique:products,sku,'.$product->id,
            'price' => 'sometimes',
            'description' => 'sometimes|min:4|max:200',
        ]);


        $product->update($request->all());
        
        return ['message' => 'Successfully Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $products = Product::findOrFail($id);

        $products->delete();

        return ['message' => 'Deleted Successfully'];
    }
}
