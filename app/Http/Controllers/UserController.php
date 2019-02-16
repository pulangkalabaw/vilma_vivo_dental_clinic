<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		// Model
        $users = new User();

        // Sorting
        // params: sort_in & sort_by
        if (!empty($request->get('sort_in') && !empty($request->get('sort_by')))) $users = $users->sort($request);

        // Search
        if (!empty($request->get('search_string'))) $users = $users->search($request->get('search_string'));

        // Count all before paginate
        $total = $users->count();

        // Count all users
        $total_users = User::count();

        // Insert pagination
        $users = $users->paginate((!empty($request->show) ? $request->show : 10));
        return view('pages.users.index', [
            'users' => $users,
            'users_total' => $total_users,
            'total' => $total,
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
		//
		$v = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'role' => 'required|string',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
		]);


		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

		$request['password'] = bcrypt($request['password']);
		if (User::insert($request->except(['_token', 'password_confirmation']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Added successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to add',
			]);
		}
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
		$user = User::findOrFail($id);
		return view('pages.users.edit', ['user' => $user]);
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
		$user = User::findOrFail($id);

		$v = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'role' => 'required|string',
			'email' => 'required|string|email|max:255|unique:users,email,'.$id,
		]);

		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

		if ($request->has('password') && $request->has('password_confirmation')) {
			if ($request->get('password') != $request->has('password_confirmation')) {
				$request['password'] = bcrypt($request['password']);
			}
			else {
				return back()->with([
					'notif.style' => 'danger',
					'notif.icon' => 'times-circle',
					'notif.message' => 'The password confirmation does not match.',
				]);
			}
		}

		if ($user->update($request->except(['_token', 'password_confirmation', '_method']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Added successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to add',
			]);
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		if (User::findOrFail($id)->delete()) {
            return back()->with([
                'notif.style' => 'success',
                'notif.icon' => 'plus-circle',
                'notif.message' => 'Delete successful',
            ]);
        }
        else {
            return back()->with([
                'notif.style' => 'danger',
                'notif.icon' => 'times-circle',
                'notif.message' => 'Failed to delete - Please try again',
            ]);
        }
	}
}
