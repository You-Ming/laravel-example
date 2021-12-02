<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\News;
use App\Models\Product;

class HomeController extends Controller
{
    //
    /*
     * $data['title'] = 'Home'; // Capitalize the first letter
     * $data['homenews'] = $this->news_model->read_news(3,0);//取得新消息
     * $data['bannernum'] = $this->home_model->banner_rows();//取得banner數量
     * $data['homebanner'] = $this->home_model->read_banner();//取得橫幅
     * $data['homeproduct'] = $this->product_model->read_product(4,0);//取得最新產品
     */
    public function index(){
        return view('pages.home', [
            'banners' => Banner::all(),
            'homenews' => News::orderBy('created_at', 'desc')->skip(0)->take(3)->get(),
            'products' => Product::orderBy('created_at', 'desc')->skip(0)->take(4)->get()
        ]);
    }
}
