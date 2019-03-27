<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollCreationRequest;
use Illuminate\Http\Request;
use PollHelper;

class PollController extends Controller
{
    /*
     * To create a poll
     * */
    public function createPoll()
    {
        return view('backend.poll-create');
    }

    public function savePoll(PollCreationRequest $request)
    {
        $poll = PollHelper::createPollFromRequest($request->all());

        if(!is_null($poll)){
            return redirect(route('poll.create'))
                ->with('success', "Your poll has been created successfully");
        }else{
            return redirect(route('poll.create'))
                ->with('fail', 'Something went wrong please try later!');
        }

    }

}
