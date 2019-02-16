<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

		// Model
        $inventory = new Inventory();

        // Sorting
        // params: sort_in & sort_by
        if (!empty($request->get('sort_in') && !empty($request->get('sort_by')))) $inventory = $inventory->sort($request);

        // Search
        if (!empty($request->get('search_string'))) $inventory = $inventory->search($request->get('search_string'));

        // Count all before paginate
        $total = $inventory->count();

        // Count all users
        $total_inventory = Inventory::count();

        // Insert pagination
        $inventory = $inventory->with('added')->paginate((!empty($request->show) ? $request->show : 10));
        return view('pages.inventory.index', [
            'inventories' => $inventory,
            'inventories_total' => $total_inventory,
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
		return view('pages.inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$v = Validator::make($request->all(), [
			'item_id' => 'required|string|max:255|unique:inventories,item_id',
			'item_name' => 'required|string',
			'quantity' => 'required|string',
			'item_date' => 'required|string',
			'description' => 'required|string|max:150',
		]);


		if ($v->fails()) return back()->withInput()->withErrors($v->errors());
		$request['added_by'] = Auth::user()->id;
		if (Inventory::insert($request->except(['_token']))) {
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
		$inventory = Inventory::findOrFail($id);
		return view('pages.inventory.edit', ['inventory' => $inventory]);
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
		$inventory = Inventory::findOrFail($id);

		$v = Validator::make($request->all(), [
			'item_id' => 'required|string|max:255|unique:inventories,item_id,'.$id,
			'item_name' => 'required|string',
			'quantity' => 'required|string',
			'item_date' => 'required|string',
			'description' => 'required|string|max:150',
		]);


		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

		if ($inventory->update($request->except(['_token', '_method']))) {
			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Update successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to update',
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
		if (Inventory::findOrFail($id)->delete()) {
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
