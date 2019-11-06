<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($id)
 * @method static create(array $array)
 */
class Order extends Model
{
    const STATUS_CREATED = 0;
    const STATUS_CANCELED = 1;
    const STATUS_FINALIZED = 2;

    protected $fillable = [
        'client_id', 'pizza_id', 'address_id', 'status'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
