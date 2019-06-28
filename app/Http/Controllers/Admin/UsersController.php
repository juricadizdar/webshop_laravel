<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::with('orders')->get();
		return view('admin.adminUsers')->with('users', $users);
		
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
		return view('admin.adminEditUsers')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
	
		$data = [
			'admin' => (bool)trim($request->get('admin')),
			'email' => trim($request->get('email'))
		];
		
		$save = $user->update($data);
		
		if($save){
			session()->flash('success', 'Users data updated successfully!');
			return redirect('admin/users');
		} else {
			session()->flash('danger', 'There was a problem, please try again!');
			return back();
		} 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
		$deleteUser = $user->delete();
		
		if($deleteUser){
			session()->flash('success', 'Users deleted successfully!');
			return back();
		} else {
			session()->flash('danger', 'There was a problem, please try again!');
			return back();
		} 
    }

}