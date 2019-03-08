<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Record;
use App\Tooth_Record;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = new Record();
        // $records = Record::with(['tooth'])->get();
        // return $request->all();
        // return $records = Record::sort($request)->get();
        if(!empty($request->get('sort_in') && !empty($request->get('sort_by')))) $records = Record::sort($request);

        if(!empty($request->search_string)) $records = Record::search(trim($request->search_string));

        $total = $records->count();

        $total_record = Record::count();

        $records = $records->with('tooth')->paginate((!empty($request->show) ? $request->show : 10));
		return view('pages.record.index', [
            'records' => $records,
            'total_record' => $total_record,
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
		return view('pages.record.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $v = Validator::make($request->all(), [
        	'name' => 'required',
        	'contact' => 'required',
        	'address' => 'required',
        ]);

        if ($v->fails()) return back()->withInput()->withErrors($v->errors());
        // return $request->except(['_token', 'tooth']);

        $record_id = Record::insertGetId($request->except(['_token', 'tooth']));
        if (!empty($record_id)) {
            $tooths = $request->tooth;
            foreach($tooths as $tooth){
                if(!empty($tooth['symptom'])){
                    Tooth_Record::create([
                        'record_id' => $record_id,
                        'tooth' => $tooth['tooth'],
                        'symptom' => $tooth['symptom'],
                        'description' => $tooth['description'],
                    ]);
                }
            }
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
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Record::where('id', $id)->with(['tooth'])->first();
		return view('pages.record.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Record::where('id', $id)->with(['tooth'])->first();
		return view('pages.record.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request->all();
        $v = Validator::make($request->all(), [
        	'name' => 'required',
        	'contact' => 'required',
        	'address' => 'required',
        ]);

        if ($v->fails()) return back()->withInput()->withErrors($v->errors());


        $record_id = Record::where('id', $id)->update($request->only(['name', 'contact', 'address']));
        if (!empty($record_id)) {
            $tooths = $request->tooth;
            Tooth_Record::where('record_id', $id)->delete();
            foreach($tooths as $tooth){
                if(!empty($tooth['symptom'])){
                    Tooth_Record::create([
                        'record_id' => $id,
                        'tooth' => $tooth['tooth'],
                        'symptom' => $tooth['symptom'],
                        'description' => $tooth['description'],
                    ]);
                }
            }
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
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
