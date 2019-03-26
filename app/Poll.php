<?php

namespace App;

use App\Traits\PollCreate;
use App\Traits\PollResults;
use Illuminate\Database\Eloquent\Model;



class Poll extends Model
{
    use PollCreate, PollResults;

    protected $fillable = ['question'];

    protected $guarded = [''];

    /*
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

}
