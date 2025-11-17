<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'tb_pengeluaran';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'jumlah',
        'keterangan',
    ];
}
