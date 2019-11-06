<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 * @method static find($id)
 */
class Pizza extends Model
{
    protected $fillable = [
        'flavor', 'size', 'price'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
