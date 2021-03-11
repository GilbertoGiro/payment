<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RolePermission extends Model
{
    /**
     * Database table columns
     * @var string[]
     */
    protected $fillable = [
        'role_id', 'permission_id'
    ];

    /**
     * Method to get related role
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Method to get related permission
     * @return HasOne
     */
    public function permission(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
