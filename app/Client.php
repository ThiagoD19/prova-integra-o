<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $phone)
 */
class Client extends Model
{
    public function address()
    {
        return $this->hasMany('App\Address');
    }
}
