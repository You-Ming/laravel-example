<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\ItemNotFoundException;

class AboutController extends Controller
{
    public function index(){
        return $this->show();
    }

    public function show($title = NULL){

        $abouts = About::all();

        if($title != NULL) {
            try {
                $content = $abouts->where('title', $title)->firstOrFail();
            } catch(ItemNotFoundException $e) {
                abort(404);
            }
        } else {
            $content = $abouts->first();
        }

        return view('pages.about', [
            'abouts' => $abouts,
            'content' => $content,
            'title' => $title,
        ]);
    }


}
