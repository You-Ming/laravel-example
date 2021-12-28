<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '關於我們管理' => '',
        );

        return view('admin.about.index', [
            'breadcrumbs' => $breadcrumbs,
            'abouts' => About::all(),
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
            '關於我們管理' => route('admin.about.index'),
            '新增關於我們' => '',
        );

        return view('admin.about.create', [
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
        //檢查aboutTitle是否有值
        if (!isset($request->aboutTitle) || empty($request->aboutTitle)) {
            return 'empty';
        }
        
        //檢查aboutTitle是否重複
        if (About::where('title', $request->aboutTitle)->exists()) {
            return 'repeat';
        }

        //新增about資料
        $about = new About();
        $about->title = $request->aboutTitle;
        $about->content = $request->aboutContent;
        if ($about->save()) {
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
            $about = About::findOrFail($id);
            $breadcrumbs = array(
                '關於我們管理' => route('admin.about.index'),
                '修改關於我們' => '',
            );

            return view('admin.about.edit', [
                'breadcrumbs' => $breadcrumbs,
                'about' => $about,
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
        //檢查aboutTitle是否有值
        if (!isset($request->aboutTitle) || empty($request->aboutTitle)) {
            return 'empty';
        }
        
        try {

            $about = About::findOrFail($id);

            //檢查aboutTitle是否重複
            if ($about->title != $request->aboutTitle && About::where('title', $request->aboutTitle)->exists()) {
                return 'repeat';
            }

            //更新關於我們資料
            $about->title = $request->aboutTitle;
            $about->content = $request->aboutContent;
            if ($about->save()) {
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
            $about = About::findOrFail($id);
            //刪除關於我們資料
            if (!$about->delete()) {
                return 'error';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'success';
    }
}
