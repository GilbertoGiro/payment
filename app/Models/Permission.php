<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Variable who contains 'transfer' permission name
     * @var string
     */
    public const PERMISSION_TRANSFER = 'transfer';

    /**
     * Variable who contains 'receive' permission name
     * @var string
     */
    public const PERMISSION_RECEIVE = 'receive';

    /**
     * Database table columns
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
