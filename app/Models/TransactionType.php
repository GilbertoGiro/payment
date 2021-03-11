<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    /**
     * Variable who contains 'debited' transfer type
     * @var string
     */
    public const TYPE_DEBITED = 'Debitado';

    /**
     * Variable who contains 'credited' transfer type
     * @var string
     */
    public const TYPE_CREDITED = 'Creditado';

    /**
     * Database table columns
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];
}
