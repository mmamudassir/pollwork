<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = ['name'];

    /*
     * each option belongs to/from poll
     * */
    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}
