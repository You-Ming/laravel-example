<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Pagination\Paginator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '新聞管理' => '',
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $news = News::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.news.index', [
            'breadcrumbs' => $breadcrumbs,
            'news' => $news,
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
            '新聞管理' => route('admin.news.index'),
            '新增新聞' => '',
        );

        return view('admin.news.create', [
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
        //檢查newsTitle是否有值
        if (!isset($request->newsTitle) || empty($request->newsTitle)) {
            return 'empty';
        }

        //新增news資料
        $news = new News();
        $news->title = $request->newsTitle;
        $news->content = $request->newsContent;
        $news->created_at = $request->newsTime;
        if ($news->save()) {
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
            $news_item = News::findOrFail($id);
            $breadcrumbs = array(
                '新聞管理' => route('admin.news.index'),
                '修改新聞' => '',
            );

            return view('admin.news.edit', [
                'breadcrumbs' => $breadcrumbs,
                'news_item' => $news_item,
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
        //檢查newsTitle是否有值
        if (!isset($request->newsTitle) || empty($request->newsTitle)) {
            return 'empty';
        }
        
        try {

            $news = News::findOrFail($id);

            //更新新聞資料
            $news->title = $request->newsTitle;
            $news->content = $request->newsContent;
            $news->created_at = $request->newsTime;
            if ($news->save()) {
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
            $news = News::findOrFail($id);
            //刪除新聞資料
            if (!$news->delete()) {
                return 'error';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'success';
    }

    public function search(Request $request)
    {
        $breadcrumbs = array(
            '新聞管理' => route('admin.news.index'),
            '查詢結果' => '',
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $query = $request->query('q');

        $news = News::where('title', 'LIKE', '%'.$query.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        return view('admin.news.search', [
            'breadcrumbs' => $breadcrumbs,
            'query' => $query,
            'news' => $news,
        ]);
    }
}
