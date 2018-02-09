<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestRemaining extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'request_remaining';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'requests',
    ];
}
