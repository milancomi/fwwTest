<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'start', 'end', 'title','backgroundColor','classNames'
    ];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
