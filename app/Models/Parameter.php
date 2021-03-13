<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /**
     * Variable who specify external authorizer url parameter name
     * @var string
     */
    const EXTERNAL_AUTHORIZER_URL = 'EXTERNAL_AUTHORIZER_URL';

    /**
     * Database table columns
     * @var array
     */
    protected $fillable = [
        'name', 'value', 'description'
    ];
}
