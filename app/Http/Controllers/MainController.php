<?php

namespace App\Http\Controllers;

use App\Poll;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PollHelper;

class MainController extends Controller
{
    /*
     * getting all polls
     * */
    public function getMain()
    {
        $polls = Poll::where('status',1)->orderBy('id','desc')->paginate(10, ['*'], 'polls');
        return view('index')->with(compact('polls'));
    }

    /*
     * get user selected poll
     * */
    public function getMyPoll(Request $request, $poll_id){

        $poll = Poll::find($poll_id);
        return view('poll')->with(compact('poll'));
    }

    /*
     * casting a vote after ip validation if same user ip address already exist
     * */
    public function postMyVote(Request $request){

        $resp = [];
        $ip_address = $request->ip();
        $option_id = $request->get('poll_value');

        if(!PollHelper::alreadyVoted($ip_address, $option_id)){

            $vote = Vote::create([
                'ip_address' => $ip_address,
                'option_id' => $option_id
                ]);

            $total_votes = $vote->option->poll->votes->count();

            $poll = $vote->option->poll;

            /*
             * polls percentage calculation of the basis of total votes and votes casted against each option
             * */
            $votes_result = [];
            foreach ($poll->options as $option){
                $votes = [];
                $votes['casted_option'] = $option->name;
                $votes['casted_votes'] =  $option->votes()->count();
                $votes['casted_percentages'] = number_format( ($votes['casted_votes'] / $total_votes) * 100, 2);

                $votes_result [] = $votes;
            }

            $resp['message'] = "Your vote has been successfully casted.";
            $resp['poll'] = view('includes.poll-result')->with(compact('votes_result'))->render();
            return response()->json($resp, 200);

        }else{
            $resp['success'] =false;
            $resp['message'] = "You already voted for this poll you cant vote twice!";
            return response()->json($resp, 200);
        }

    }
}
