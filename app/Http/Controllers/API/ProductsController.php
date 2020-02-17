<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * authenticated user with an api
     */
    public function user()
    {
        return auth('api')->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Product::withCount('bids')->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
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

        $product->user()->associate( auth('api')->user() );

        $product->save();

        return ['message', 'Product Successfully Added'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return $product = Bid::where('product_id',$id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::findOrFail($id);

        $products->delete();

        return ['message' => 'Deleted Successfully'];
    }
}
