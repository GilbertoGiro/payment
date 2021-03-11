<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Variable who contains 'common' user role
     * @var string
     */
    public const ROLE_COMMON = 'Usuário';

    /**
     * Variable who contains 'shopkeeper' role
     * @var string
     */
    public const ROLE_SHOPKEEPER = 'Lojista';

    /**
     * Database table columns
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
