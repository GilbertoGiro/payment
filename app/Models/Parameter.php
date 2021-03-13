<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    /**
     * Variable who specify external authorizer service url parameter name
     * @var string
     */
    const EXTERNAL_AUTHORIZER_URL = 'EXTERNAL_AUTHORIZER_URL';

    /**
     * Variable who specify external notification service url parameter name
     * @var string
     */
    const EXTERNAL_NOTIFICATION_URL = 'EXTERNAL_NOTIFICATION_URL';

    /**
     * Database table columns
     * @var array
     */
    protected $fillable = [
        'name', 'value', 'description'
    ];
}
