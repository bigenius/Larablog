<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'confirmed' => trans('strings.password_mismatch')
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();
        return redirect()->route('lb-admin.user.index')->with(['info' => 'User created!', 'status' => 'success' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::withTrashed()
            ->where('id', $id)
            ->get()->first();
        return view('admin.user.edit', compact('user'));
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
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('lb-admin.user.index')->with(['info' => 'User deleted!', 'status' => 'success' ]);
    }


    public function deleted()
    {
        $users = User::onlyTrashed()->orderBy('deleted_at')->get();
        return view('admin.user.deleted', compact('users'));
    }

    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('lb-admin.user.index')->with(['info' => 'User restored!', 'status' => 'success' ]);
    }

    public function getPass($id = false)
    {
        if($id) {
            $user = User::findOrFail($id);
        } else {
            $user = Auth::user();
        }
        return view('admin.user.changepass', compact('user'));
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ], [
            'confirmed' => trans('strings.password_mismatch')
        ]);

        if( $request->has('id') ) {
            $user = User::findOrFail($request->id);
        } else {
            $user = Auth::user();
        }
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->back()->with(['info' => 'Password updated!', 'status' => 'success' ]);
    }





}
