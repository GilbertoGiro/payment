<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Database table columns
     * @var array
     */
    protected $fillable = [
        'name', 'cpf', 'email', 'password', 'role_id'
    ];

    /**
     * Attribute who specify that password is an hidden column
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Method to get related role
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
