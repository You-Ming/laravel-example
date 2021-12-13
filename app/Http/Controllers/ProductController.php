<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Support\ItemNotFoundException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = NULL)
    {
        $product_types = ProductType::all();

        if($type != NULL) {
            try {
                $products = ProductType::where('name', $type)->firstOrFail()->products;
            } catch(ItemNotFoundException $e) {
                abort(404);
            }
        } else {
            $products = Product::all();
        }

        return view('products.index', [
            'type' => $type,
            'product_types' => $product_types,
            'products' => $products,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($type = NULL, $name = NULL)
    {
        $product_types = ProductType::all();

        if($type != NULL && $name !=NULL) {
            try {
                $product = Product::where('name', $name)->firstOrFail();
                $product_spec = json_decode($product->specification);
            } catch(ItemNotFoundException $e) {
                abort(404);
            }
        } else {
            abort(404);
        }

        if($type != $product->product_type->name){
            abort(404);
        }

        return view('products.show', [
            'type' => $type,
            'product_types' => $product_types,
            'product' => $product,
            'product_spec' => $product_spec,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
