<?php

namespace App\Http\Controllers\Api;

use App\Poll;
use App\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use PollHelper;
use Validator;

class PollController extends Controller
{
    public function getPolls(Request $request)
    {
        $page = 1;
        if ($request->has('page')) {
            $page = $request->get('page');
        }
        $limit = 5;
        $skip = ($page - 1) * $limit;

        $query = Poll::where('status',1);

        $count_query = clone $query;
        $count = $count_query->count();

        $polls = $query->orderBy('id', 'DESC')
            ->skip($skip)
            ->take($limit)
            ->get();

        $all_polls = [];
        foreach ($polls as $poll) {
            $row_data = [];
            $row_data['question'] = $poll->question;
            $row_data['options'] = $poll->options;
            $row_data['created_at'] = $poll->created_at;
            $all_polls[] = $row_data;
        }

        $polls = new LengthAwarePaginator($all_polls, $count, $limit, $page, [
            'path' => route('polls.api'),
            'query' => $request->query(),
        ]);

        return response()->json($polls, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postMyVote(Request $request){

        $resp = [];
        $request->validate([
            'ip_address' => 'required|string|max:255',
            'option_id' => 'required',
            'poll_id' => 'required',
        ]);

        $ip_address = $request->get('ip_address');
        $option_id  = $request->get('option_id');
        $poll_id =  $request->get('poll_id');

        if(!PollHelper::validOption($poll_id, $option_id)){
            $resp['success'] =false;
            $resp['message'] = "This vote option is invalid!";
            return response()->json($resp, 200);
        }

        if(!PollHelper::alreadyVoted($ip_address, $option_id, $poll_id)){

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
                $votes['casted_option_id'] = $option->id;
                $votes['casted_option'] = $option->name;
                $votes['casted_votes'] =  $option->votes()->count();
                $votes['casted_percentages'] = number_format( ($votes['casted_votes'] / $total_votes) * 100, 2) .' %';

                $votes_result [] = $votes;
            }

            $resp['message'] = "Your vote has been casted successfully.";
            $resp['poll_result'] = $votes_result;
            return response()->json($resp, 200);

        }else{
            $resp['success'] =false;
            $resp['message'] = "You already voted for this poll you cant vote twice!";
            return response()->json($resp, 200);
        }

    }
}
