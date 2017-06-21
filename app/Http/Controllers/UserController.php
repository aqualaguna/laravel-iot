<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
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
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{

		$user = $request->user();
		$user->subcribe_type = $request->subcribe_type;
		if ($request->subcribe_type == 'monthly' || $request->subcribe_type == 'yearly') {
			if ($user->subcribe_type == 'monthly') {
		    	if($user->credit>200000)
			    	$user->credit -=200000;
		    	else
		    		return response()->json(['status'=>'failed','message'=>'User Credit is not enoguh']);
			}
			else {
				if($user->credit>2000000)
					$user->credit -=2000000;
				else
					return response()->json(['status'=>'failed','message'=>'User Credit is not enoguh']);
			}
			$user->subcribe_at = Carbon::now();
		}
		if ($user->subcribe_type == 'lifetime') {
			$user->is_lifetime = true;
		}
		$user->save();

		return response()->json(['status' => 'succes'], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\User $user
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user)
	{
		//
	}
}
