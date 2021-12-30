<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '產品分類管理' => '',
        );

        $product_types = ProductType::all();

        return view('admin.product_type.index', [
            'breadcrumbs' => $breadcrumbs,
            'product_types' => $product_types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = array(
            '產品分類管理' => route('admin.product_type.index'),
            '新增產品分類' => '',
        );

        return view('admin.product_type.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //檢查productTypeName是否有值
        if (!isset($request->productTypeName) || empty($request->productTypeName)) {
            return 'empty';
        }
        
        //檢查productTypeName是否重複
        if (ProductType::where('name', $request->productTypeName)->exists()) {
            return 'repeat';
        }

        //設定產品分類資料
        $product_type = new ProductType();
        $product_type->name = $request->productTypeName;

        //新增productType資料
        if ($product_type->save()) {
            return 'success';
        } else {
            return 'createError';
        }

        return 'error';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $breadcrumbs = array(
                '產品分類管理' => route('admin.product_type.index'),
                '修改產品分類' => '',
            );

            $product_type = ProductType::findOrFail($id);;

            return view('admin.product_type.edit', [
                'breadcrumbs' => $breadcrumbs,
                'product_type' => $product_type,
            ]);
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }
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
        //檢查productTypeName是否有值
        if (!isset($request->productTypeName) || empty($request->productTypeName)) {
            return 'empty';
        }
        
        try {

            //取得產品分類
            $product_type = ProductType::findOrFail($id);

            //檢查productTypeName是否重複
            if ($product_type->name != $request->productTypeName && ProductType::where('name', $request->productTypeName)->exists()) {
                return 'repeat';
            }

            //修改產品分類資料
            $product_type->name = $request->productTypeName;

            if ($product_type->save()) {
                return 'success';
            } else {
                return 'updateError';
            }

        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'error';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product_type = ProductType::findOrFail($id);

            //刪除產品分類資料
            if (!$product_type->delete()) {
                return 'error';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'success';
    }
}
