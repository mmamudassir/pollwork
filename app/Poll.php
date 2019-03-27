<?php

namespace App;

use App\Traits\PollCreate;
use Illuminate\Database\Eloquent\Model;



class Poll extends Model
{
    use PollCreate;

    protected $fillable = ['question'];

    /*
     * every pool has multiple options
     * */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /*
     * every poll has multiple votes
     * */
    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Option::class);
    }

    /*
     * getting all poll option id's
     * */
    public function getPollOptionsId()
    {
        return $this->options->pluck('id');
    }

}
