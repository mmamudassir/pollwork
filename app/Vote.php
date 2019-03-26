<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['ip_address', 'option_id'];

    /*
     * every vote belongs to an option
     * */
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
