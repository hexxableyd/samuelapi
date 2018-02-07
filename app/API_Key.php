<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class API_Key extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'api_keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'key', 'name',
    ];
}
