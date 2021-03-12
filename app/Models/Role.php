<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Variable who contains 'user' role
     * @var string
     */
    public const ROLE_USER = 'Usuário';

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

    /**
     * Method to get related role_permissions
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rolePermission()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }
}
