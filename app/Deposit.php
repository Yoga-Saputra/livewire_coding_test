<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposit';

    protected $fillable = [
        'rekening_tujuan', 'rekening_asal', 'jumlah', 'catatan', 'status'
    ];
}
