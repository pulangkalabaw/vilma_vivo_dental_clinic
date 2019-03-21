<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Inventory;
use App\InventoryOut;
use App\InventoryHistory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

	public function out (Request $request)
	{
		$inventory = Inventory::get();
		return view('pages.inventory.out', [
			'inventories' => $inventory
		]);
	}

	public function processOut (Request $request)
	{
		$v = Validator::make($request->all(), [
			'inventory_id' => 'required',
			'quantity' => 'required|string',
			'remarks' => 'nullable|max:199',
		]);

		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

		$inventory = Inventory::findOrFail($request->get('inventory_id'));
		$current_quantity = (int) $inventory->quantity - $request->post('quantity');


		$inventory = $inventory->update(['quantity' => $current_quantity]);
		$request['added_by'] = Auth::user()->id;

		$request['remaining_quantity'] = $current_quantity;

		if (InventoryOut::create($request->except(['_token']))) {

			return back()->with([
				'notif.style' => 'success',
				'notif.icon' => 'plus-circle',
				'notif.message' => 'Inventory out successful!',
			]);
		}
		else {
			return back()->with([
				'notif.style' => 'danger',
				'notif.icon' => 'times-circle',
				'notif.message' => 'Failed to out',
			]);
		}
	}


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
		if ($inventory_id = Inventory::insertGetId($request->except(['_token']))) {

			$ih_data = $request->except(['_token']);
			$ih_data['inventory_id'] = $inventory_id;
			InventoryHistory::create($ih_data);

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
		$inventory = Inventory::with('history')->where('id', $id)->first();
		return !empty($inventory) ? ['status' => 200, 'data' => $inventory] : ['status' => 404, 'data' => []];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$inventory = Inventory::with(['history', 'out', 'out.added', 'out.inventory'])->findOrFail($id);
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
			'item_date' => 'required|string',
			'description' => 'required|string|max:150',
		]);


		if ($v->fails()) return back()->withInput()->withErrors($v->errors());

		if ($inventory->update($request->except(['_token', '_method']))) {

			$ih_data = $request->except(['_token']);
			$ih_data['inventory_id'] = $id;
			$ih_data['quantity'] = $inventory->quantity;
			$ih_data['added_by'] = $inventory->added_by;
			InventoryHistory::create($ih_data);


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
