<?php

use App\Poll;
use App\Vote;

/**
 * Created by PhpStorm.
 * User: Mudassir Ali
 * Date: 3/26/2019
 * Time: 4:51 PM
 */

/* Helper class for polls
 * */
class PollHelper {

    public static function createPollFromRequest($request)
    {

        $poll = new Poll([
            'question' => $request['question'],
        ]);

        $poll->addOptions($request['options']);
        $poll->generate();
        return $poll;
    }

    public static function alreadyVoted($ip_address, $option_id){
        $voted = Vote::where('ip_address', $ip_address)
            ->where('option_id', $option_id)
            ->count();

        if($voted > 0 ){
         return true;
        }else{
            return false;
        }
    }
}