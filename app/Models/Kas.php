<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    protected $table = 'tb_kas';          // your table name
    protected $primaryKey = 'id_kas';     // your primary key
    public $timestamps = false;           // your table has no timestamps

    protected $fillable = [
        'jumlah_bayar',
        'tanggal_bayar',
        'jumlah_tunggakan',
    ];
}
