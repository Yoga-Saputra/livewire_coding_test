<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekening';

    protected $fillable = [
        'name'
    ];

    public function deposit()
    {
        return $this->hasMany('App\Deposit');
    }
}
