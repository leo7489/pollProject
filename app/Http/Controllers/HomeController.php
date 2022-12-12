<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //data for user
        //find out all users that have finished the survey
        $user_ids = DB::table('survey_logs')->distinct()->pluck('user_id');

        $current_user_id = auth()->user()->id;

        //data for user
        //check if the current user has voted
        $hasDone = false;
        foreach($user_ids as $user_id){
            if($user_id == $current_user_id){
                $hasDone = true;
                break;
            }
        }

        //data for admin
        $today = new Carbon();
        //find polls that active and can NOT edit
        $polls_no_edit = DB::table('polls')
                ->whereDate("start_date", '<=', $today)
                ->whereDate("finish_date", '>=', $today)
                ->pluck('id')
                ->toArray();

        //retrive all polls with their choices
        $surveys = [];
        $polls = DB::table('polls')->get();

        foreach($polls as $poll){
            //get all options for specific poll, then save all options in an array
            $option_records = DB::table('poll_options')
            ->select('option','id as option_id')
            ->where('poll_id', '=', $poll->id)
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
            
            $poll_info = [
                'poll_id'     => $poll->id,
                'poll_name'   => $poll->name,
                'description' => $poll->description,
                'options'     => $option_records,
            ];

            array_push($surveys, $poll_info);
        }

        return view('home', ['questions'=>$surveys, 'hasDone' => $hasDone, 'no_edit' => $polls_no_edit]);
    }
}
