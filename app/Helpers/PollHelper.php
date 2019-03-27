<?php

use App\Option;
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

        /*
         * creating poll with options
         * */
        $poll = new Poll([
            'question' => $request['question'],
        ]);
        $poll->addOptions($request['options']);
        $poll->generate();
        return $poll;
    }

    public static function alreadyVoted($ip_address, $option_id){

        /*
         * finding poll all options with current poll option
         * */
        $option = Option::find($option_id);
        $option_ids = $option->poll->getPollOptionsId();

        /*
         * checking user ip exist in current poll options
         * */
        $voted = Vote::where('ip_address', $ip_address)
            ->whereIn('option_id', $option_ids)
            ->count();

        if($voted > 0 ){
         return true;
        }else{
            return false;
        }
    }

    public static function validOption($poll_id, $option_id){

        /*
         * finding poll all options with current poll option
         * */
        $option_exist = Option::Where('poll_id', $poll_id)
            ->where('id', $option_id)
            ->count();

        if($option_exist > 0 ){
            return true;
        }else{
            return false;
        }
    }
}