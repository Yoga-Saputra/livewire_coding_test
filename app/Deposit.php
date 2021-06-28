<?php

namespace App;

use App\Rekening;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = 'deposit';

    protected $fillable = [
        'rekening_id', 'rekening_asal', 'jumlah', 'catatan', 'status'
    ];
    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}
