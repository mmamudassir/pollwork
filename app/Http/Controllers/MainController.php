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

    public function postMyVote(Request $request){

        $resp = [];
        $resp['success'] = true;
        $ip_address = $request->ip();
        $option_id = $request->get('poll_value');

        if(!PollHelper::alreadyVoted($ip_address, $option_id)){

            $vote = Vote::create([
                'ip_address' => $ip_address,
                'option_id' => $option_id
                ]);

            $resp['count'] = $total_votes = $vote->option->poll->votes->count();

            dd($resp);
            /*
             * calculation of vote for each option is next task
             * */
//            return response()->json(['success'=>'vote is successfullly casted', 'votes'=>$]);
//            dd($vote->option->poll->votes);
        }else{
            dd('already voted');
        }



    }
}
