<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\PollResult;
use Carbon\Carbon;

class PollResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = new Carbon();
        //find polls that are active
        $polls = DB::table('polls')
            ->whereDate("start_date", '<=', $today)
            ->whereDate("finish_date", '>=', $today)
            ->get();

        $surveys = [];
        foreach($polls as $poll){
            //get all options for specific poll, then save all options in an array
            $option_records = DB::table('poll_options')
            ->select('option','id as option_id')
            ->where('poll_id', '=', $poll->id)
            ->orderBy('id', 'asc')
            ->get()->toArray();
            
            $poll_info = [
                'poll_id' => $poll->id,
                'poll_name' => $poll->name,
                'options' => $option_records,
            ];

            array_push($surveys, $poll_info);
        }

        return view('pollResult.index', ['questions'=>$surveys]);
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
        $validated = $request->validate([
            'feedbacks.*.poll_option_id' => 'required|numeric',
        ]);
        
        $validated['user_id'] = auth()->user()->id;
        //save survey results to db
        $option_ids = $validated['feedbacks'];
        foreach($option_ids as $option_id){
            DB::table('poll_results')->insert([
                'poll_option_id' => $option_id['poll_option_id'],
                'user_id'        => $validated['user_id'],
                'created_at'     => new Carbon(),
            ]);
        }
        //log a user who has finished survey
        DB::table('survey_logs')->insert([
            'user_id'   => $validated['user_id'],
            'created_at'=> new Carbon(),
        ]);

        return redirect('/home');
    }

    public function report(){
        $current_user_id = auth()->user()->id;

        $records = DB::table('polls')
                    ->leftJoin('poll_options', 'polls.id', '=', 'poll_options.poll_id')
                    ->Join('poll_results', 'poll_options.id', '=', 'poll_results.poll_option_id')
                    ->select('polls.name', 'poll_options.option')
                    ->where('poll_results.user_id', '=', $current_user_id)
                    ->get();
        // print_r($records);
        return view('pollResult.report', ['records' => $records]);
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
        //
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
        //
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
