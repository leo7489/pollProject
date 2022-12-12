<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;
use DB;
use Carbon\Carbon;

class PollOptionController extends Controller
{
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
    public function create($id)
    {
        return view("pollOption.create", ['poll' => Poll::findOrFail($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'options.*'  => 'required',
            'poll_id'    => 'required|numeric',
        ]);

        foreach($validated['options'] as $option){
            DB::table('poll_options')->insert([
                'poll_id'   => $request->poll_id,
                'option'    => $option,
                'created_at'=> new Carbon(),
            ]);
        }
        
        return redirect('/home');
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
        $poll    = DB::table('polls')->find($id); 
        $options = DB::table('poll_options')->where('poll_id', $id)->get();

        return view('pollOption.edit', ['poll_options' => $options, 'poll' => $poll]);
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
        $validated = $request->validate([
            'options.*'  => 'required',
            'ids.*'      => 'required|numeric',
        ]);

        for($i = 0; $i<count($validated['ids']); $i++){
            DB::table('poll_options')
                ->where('id', '=', $validated['ids'][$i])
                ->update(['option' => $validated['options'][$i]]);
        }

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
