<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'parameters';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'param', 'data_type', 'description', 'required',
    ];
}
