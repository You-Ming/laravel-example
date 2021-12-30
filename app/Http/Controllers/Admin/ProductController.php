<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\ProductType;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '產品管理' => '',
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.product.index', [
            'breadcrumbs' => $breadcrumbs,
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
        $breadcrumbs = array(
            '產品管理' => route('admin.product.index'),
            '新增產品' => '',
        );

        $types = ProductType::all();

        return view('admin.product.create', [
            'breadcrumbs' => $breadcrumbs,
            'types' => $types,
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
        //檢查productName是否有值
        if (!isset($request->productName) || empty($request->productName)) {
            return 'empty';
        }

        //檢查productType是否有值
        if (!isset($request->productType) || empty($request->productType)) {
            return 'typeEmpty';
        }
        
        //檢查productName是否重複
        if (Product::where('name', $request->productName)->exists()) {
            return 'repeat';
        }

        //確認request是否有圖片
        if(!$request->hasFile('file_productImg')){ 
            return 'uploadEmpty';
        }

        //上傳圖片
        //$path = Storage::putFile('/public/uploads/images/product', $request->file('file_productImg'));
        $path = $request->file('file_productImg')->store('/public/uploads/images/product');

        if (!Storage::exists($path)) {
            return 'uploadError';
        }

        //取得產品分類
        $product_type = ProductType::where('name', $request->productType)->first();

        //檢查產品分類是否存在
        if ($product_type) {
            $file_name = basename($path); //取得檔案名稱
            //設定產品資料
            $product = new Product();
            $product->name = $request->productName;
            $product->image_name = $file_name;
            $product->specification = $request->productSpecification;
            $product->description = $request->productDescription;
            //以產品分類角度新增product資料
            if ($product_type->products()->save($product)) {
                return 'success';
            } else {
                return 'createError';
            }
        } else {
            return 'typeEmpty';
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
                '產品管理' => route('admin.product.index'),
                '修改產品' => '',
            );
            $product = Product::findOrFail($id);
            $types = ProductType::all();

            return view('admin.product.edit', [
                'breadcrumbs' => $breadcrumbs,
                'product' => $product,
                'types' => $types,
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
        //檢查productName是否有值
        if (!isset($request->productName) || empty($request->productName)) {
            return 'empty';
        }

        //檢查productType是否有值
        if (!isset($request->productType) || empty($request->productType)) {
            return 'typeEmpty';
        }
        
        try {

            //取得產品
            $product = Product::findOrFail($id);

            //取得產品分類
            $product_type = ProductType::where('name', $request->productType)->firstOrFail();

            //檢查productName是否重複
            if ($product->name != $request->productName && Product::where('name', $request->productName)->exists()) {
                return 'repeat';
            }

            //修改產品資料
            $product->name = $request->productName;
            $product->specification = $request->productSpecification;
            $product->description = $request->productDescription;
            //修改產品分類關聯
            $product->product_type()->associate($product_type);

            if ($product->save()) {
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
            $product = Product::findOrFail($id);
            $path = '/public/uploads/images/product/' . $product->image_name;
            if (Storage::exists($path)) {
                //刪除圖片
                Storage::delete($path);
            }
            //刪除橫幅資料
            if (!$product->delete()) {
                return 'error';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'success';
    }

    /**
     * Show the form for editing the specified resource.
     * 更新產品圖片頁面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_image($id)
    {
        try {
            $product = Product::findOrFail($id);
            $breadcrumbs = array(
                '產品管理' => route('admin.product.index'),
                '修改產品' => route('admin.product.edit', ['product' => $id]),
                '更新產品圖片' => '',
            );

            return view('admin.product.edit_image', [
                'breadcrumbs' => $breadcrumbs,
                'product' => $product,
            ]);
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     * 更新產品圖片
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_image(Request $request, $id)
    {
        try {

            $product = Product::findOrFail($id);

            //確認request是否有圖片
            if(!$request->hasFile('file_productImg_update')){ 
                return redirect()->route('admin.product.image.edit', ['product' => $id])->with('danger', '請選擇圖片');
            }

            //上傳圖片
            //$path = Storage::putFile('/public/uploads/images/product', $request->file('file_productImg_update'));
            $path = $request->file('file_productImg_update')->store('/public/uploads/images/product');

            if (!Storage::exists($path)) {
                //圖片上傳失敗
                return redirect()->route('admin.product.edit', ['product' => $id])->with('danger', '圖片上傳失敗');
            }
            
            //更新product資料
            $file_name = basename($path); //取得檔案名稱
            $old_image_name = $product->image_name; //舊的產品圖片名稱
            $product->image_name = $file_name;
            if ($product->save()) {
                //刪除舊的產品圖片
                $old_image_path = '/public/uploads/images/product/' . $old_image_name;
                if (Storage::exists($old_image_path)) {
                    Storage::delete($old_image_path);
                }
                //圖片更新成功
                return redirect()->route('admin.product.edit', ['product' => $id])->with('success', '圖片更新成功');
            } else {
                //圖片更新失敗
                return redirect()->route('admin.product.edit', ['product' => $id])->with('danger', '圖片更新失敗');
            }

        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return redirect()->route('admin.product.edit', ['product' => $id])->with('danger', '錯誤');
    }

    public function search(Request $request)
    {
        $breadcrumbs = array(
            '產品管理' => route('admin.product.index'),
            '查詢結果' => '',
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $query = $request->query('q');

        $products = Product::where('name', 'LIKE', '%'.$query.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        return view('admin.product.search', [
            'breadcrumbs' => $breadcrumbs,
            'query' => $query,
            'products' => $products,
        ]);
    }

}
