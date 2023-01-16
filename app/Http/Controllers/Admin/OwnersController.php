<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Owner; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon; //日付ライブラリ
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OwnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')->paginate(10);
        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        入力されたデータを検証して、それが妥当であるかどうかを確認する。
        emailフィールドは必須であり、文字列であること、メールアドレスであること、
        最大255文字以内であること、およびOwnersテーブル内でユニークであることを確認している。
        passwordフィールドは必須であり、確認用のパスワードと一致していること、
        Passwordクラスによって定義されたデフォルトのルールを満たしていることを確認している。
        */
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Owner::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        /*
        Ownerクラスを使用して新しいオーナーを作成し、そのデータをデータベースに保存する。
        また、パスワードはHash::make()を使用してハッシュ化される
        */
        Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => 'Completion of registration',
                'status' => 'info']);
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
    public function edit($id)//何番目の情報か
    {
        $owner = Owner::findOrFail($id);
        //dd($owner);
        return view('admin.owners.edit', compact('owner'));
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
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);
        $owner->save();

        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => 'Updated!',
                'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();//ソフトデリ―ト
        return redirect()
        ->route('admin.owners.index')
        ->with(['message' => 'deleted!',
                'status' => 'alert']);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwner = Owner::onlyTrashed()->get();
        return view('admin.expired-owners', compact('expiredOwner'));
    }

    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.expired-owners.index');
    }
}
