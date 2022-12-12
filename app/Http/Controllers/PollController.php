<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use DB;
use Carbon\Carbon;


class PollController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poll.create');
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
            'name'        => 'required|unique:polls|max:60',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'finish_date' => 'required|date',
        ]);

        $poll = Poll::create($validated);

        return redirect('/poll/'.$poll->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('poll.show', ['poll' => Poll::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poll = DB::table('polls')->find($id);
        $poll_options = DB::table('poll_options')->where('poll_id', $id)->get();

        // dd($poll);
        // dd($poll_options);
        return view('poll.editPoll', ['poll'=>$poll, 'poll_options'=>$poll_options]);
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
            'id'          => 'required|numeric',
            'name'        => 'required|unique:polls|max:60',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'finish_date' => 'required|date',
        ]);

        $data = [
            'name'        => $request->name,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'finish_date' => $request->finish_date,
            'updated_at'  => new Carbon(),
        ];

        DB::table('polls')->where("id", $request->id)->update($data); 

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'poll_id' => 'required|numeric',
        ]);

        DB::table('polls')->where('id', $validated['poll_id'])->delete();

        DB::table('poll_options')->where('poll_id', $validated['poll_id'])->delete();

        return redirect('/home');
    }
}
