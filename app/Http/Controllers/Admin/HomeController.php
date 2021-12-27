<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '橫幅管理' => '',
        );

        return view('admin.home.index', [
            'banners' => Banner::orderBy('created_at', 'desc')->get(),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 新增橫幅頁面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $breadcrumbs = array(
            '橫幅管理' => route('admin.home.index'),
            '新增橫幅' => '',
        );

        return view('admin.home.create', [
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 新增橫幅
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //檢查bannerName是否有值
        if (!isset($request->bannerName) || empty($request->bannerName)) {
            return 'empty';
        }
        
        //檢查bannerName是否重複
        if (Banner::where('name', $request->bannerName)->exists()) {
            return 'repeat';
        }

        //上傳圖片
        //$path = Storage::putFile('/public/uploads/images/banner', $request->file('file_BannerImg'));
        $path = $request->file('file_BannerImg')->store('/public/uploads/images/banner');

        if (!Storage::exists($path)) {
            return 'uploadError';
        }

        //新增banner資料
        $file_name = basename($path); //取得檔案名稱
        $banner = new Banner();
        $banner->name = $request->bannerName;
        $banner->title = $request->bannerTitle;
        $banner->image_name = $file_name;
        if ($banner->save()) {
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
     * 更新橫幅頁面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $breadcrumbs = array(
                '橫幅管理' => route('admin.home.index'),
                '修改橫幅' => '',
            );

            return view('admin.home.edit', [
                'breadcrumbs' => $breadcrumbs,
                'banner' => $banner,
            ]);
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     * 更新橫幅
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //檢查bannerName是否有值
        if (!isset($request->bannerName) || empty($request->bannerName)) {
            return 'empty';
        }
        
        try {

            $banner = Banner::findOrFail($id);

            //檢查bannerName是否重複
            if ($banner->name != $request->bannerName && Banner::where('name', $request->bannerName)->exists()) {
                return 'repeat';
            }

            //更新橫幅資料
            $banner->name = $request->bannerName;
            $banner->title = $request->bannerTitle;
            if ($banner->save()) {
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
     * 刪除橫幅
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $path = '/public/uploads/images/banner/' . $banner->image_name;
            if (Storage::exists($path)) {
                //刪除圖片
                Storage::delete($path);
            }
            //刪除橫幅資料
            if (!$banner->delete()) {
                return 'error';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'success';
    }

    /**
     * Show the form for editing the specified resource.
     * 更新橫幅圖片頁面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_image($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $breadcrumbs = array(
                '橫幅管理' => route('admin.home.index'),
                '修改橫幅' => route('admin.home.edit', ['home' => $id]),
                '更新橫幅圖片' => '',
            );

            return view('admin.home.edit_image', [
                'breadcrumbs' => $breadcrumbs,
                'banner' => $banner,
            ]);
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     * 更新橫幅圖片
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_image(Request $request, $id)
    {
        try {

            $banner = Banner::findOrFail($id);

            //上傳圖片
            //$path = Storage::putFile('/public/uploads/images/banner', $request->file('file_bannerImg_update'));
            $path = $request->file('file_bannerImg_update')->store('/public/uploads/images/banner');

            if (!Storage::exists($path)) {
                //圖片上傳失敗
                return redirect()->route('admin.home.edit', ['home' => $id])->with('danger', '圖片上傳失敗');
            }
            
            //更新banner資料
            $file_name = basename($path); //取得檔案名稱
            $old_image_name = $banner->image_name; //舊的橫幅名稱
            $banner->image_name = $file_name;
            if ($banner->save()) {
                //刪除舊的橫幅圖片
                $old_image_path = '/public/uploads/images/banner/' . $old_image_name;
                if (Storage::exists($old_image_path)) {
                    Storage::delete($old_image_path);
                }
                //圖片更新成功
                return redirect()->route('admin.home.edit', ['home' => $id])->with('success', '圖片更新成功');
            } else {
                //圖片更新失敗
                return redirect()->route('admin.home.edit', ['home' => $id])->with('danger', '圖片更新失敗');
            }

        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return redirect()->route('admin.home.edit', ['home' => $id])->with('danger', '錯誤');
    }

}
