<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = array(
            '帳號管理' => '',
        );

        $users = User::all();

        return view('admin.user.index', [
            'breadcrumbs' => $breadcrumbs,
            'users' => $users,
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
            '帳號管理' => route('admin.user.index'),
            '新增帳號' => '',
        );

        return view('admin.user.create', [
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
        //檢查adminName,adminEmail,adminPassword是否有值
        if (!isset($request->adminName) || empty($request->adminName) || 
            !isset($request->adminEmail) || empty($request->adminEmail) || 
            !isset($request->adminPassword) || empty($request->adminPassword)) {
            return 'empty';
        }
        
        //檢查adminEmail是否重複
        if (User::where('email', $request->adminEmail)->exists()) {
            return 'repeat';
        }

        //檢查Password是否一致
        if ($request->adminPassword != $request->adminPassword2) {
            return 'passwordError';
        }

        //設定資料
        $user = new User();
        $user->name = $request->adminName;
        $user->email = $request->adminEmail;
        $user->password = Hash::make($request->adminPassword);

        //新增User資料
        if ($user->save()) {
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
                '帳號管理' => route('admin.user.index'),
                '修改帳號' => '',
            );

            $user = User::findOrFail($id);;

            return view('admin.user.edit', [
                'breadcrumbs' => $breadcrumbs,
                'user' => $user,
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
        //檢查adminName,adminPassword是否有值
        if (!isset($request->adminName) || empty($request->adminName) || 
            !isset($request->adminPassword) || empty($request->adminPassword)) {
            return 'empty';
        }

        //檢查確認密碼是否與密碼一致
        if ($request->adminPassword != $request->adminPassword2) {
            return 'passwordError';
        }

        //檢查登入者與request的id是否一致,檢查權限(admin有最高權限,跳過檢查)
        $auth = auth()->user();
        if ($auth->email != 'admin' && $auth->id != $id){
            return 'permissionsError';
        }
        
        try {
            //取得User資料
            $user = User::findOrFail($id);

            //修改User資料
            $user->name = $request->adminName;
            $user->password = Hash::make($request->adminPassword);

            if ($user->save()) {
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
    public function destroy(Request $request, $id)
    {
        //檢查adminEmail,adminPassword是否有值
        if (!isset($request->adminEmail) || empty($request->adminEmail) || 
            !isset($request->adminPassword) || empty($request->adminPassword)) {
            return 'empty';
        }

        try {

            $user = User::findOrFail($id);

            //檢查E-mail是否一致
            if ($request->adminEmail != $user->email) {
                return 'error';
            }

            //檢查密碼是否錯誤
            if (! Hash::check($request->adminPassword, $user->password)) {
                return 'passwordError';
            }

            //刪除使用者
            if ($user->delete()) {
                return 'success';
            } else {
                return 'deleteError';
            }
            
        } catch(ItemNotFoundException $e) {
            abort(404);
        }

        return 'error';
    }
}
