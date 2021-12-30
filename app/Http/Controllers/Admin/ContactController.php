<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '聯絡我們管理' => '',
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contact.index', [
            'breadcrumbs' => $breadcrumbs,
            'contacts' => $contacts,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $breadcrumbs = array(
            '聯絡我們管理' => route('admin.contact.index'),
            '查看留言' => ''
        );

        try {

            $contact = Contact::findOrFail($id);
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return view('admin.contact.show', [
            'breadcrumbs' => $breadcrumbs,
            'contact' => $contact,
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
        try {
            $contact = Contact::findOrFail($id);
            //刪除聯絡我們資料
            if (!$contact->delete()) {
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
            '聯絡我們管理' => route('admin.contact.index'),
            '查詢結果' => ''
        );

        //links using Bootstrap CSS
        Paginator::useBootstrap();

        $query = $request->query('q');

        $contacts = Contact::where('title', 'LIKE', '%'.$query.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10)
                    ->withQueryString();

        return view('admin.contact.search', [
            'breadcrumbs' => $breadcrumbs,
            'query' => $query,
            'contacts' => $contacts,
        ]);

    }
    
}
