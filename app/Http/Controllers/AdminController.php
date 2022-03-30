<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$page_title="Admins";
		$view='pages.users.index';
		$user = Auth::user();
		if(isset($user->username) && $user->role->name == 'Admin'){
			$users = User::paginate();
			return view($view, compact('users', 'page_title'));
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required',
            'email' => 'required|email',
            //'password' => 'password|confirmed|min:4',
            //'confirm-password' => 'password|confirmed|min:4',
            'role_id' => 'required',
        ]);
		
		//dd($request->input());
        User::create([
			'name'=> $request->name,
			'username' => $request->username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
			'role_id' => $request->role_id
		]);
       
        return redirect()
				->route('admins.index')
				->with('success','User created successfully.');
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
		$user = User::find($id);
        return view('pages.users.edit',compact('user'));
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
        $request->validate([
            'name' => 'required|min:3|max:50',
            'username' => 'required',
            'email' => 'required|email',
            //'password' => 'password|confirmed|min:4',
            //'confirm-password' => 'password|confirmed|min:4',
            'role_id' => 'required',
        ]);
		$user = User::find($id);
        $user->update([
			'name'=> $request->name,
			'username' => $request->username,
			'email' => $request->email,
			//'password' => Hash::make($request->password),
			'role_id' => $request->role_id
		]);
      
        return redirect()
				->route('admins.index')
				->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
