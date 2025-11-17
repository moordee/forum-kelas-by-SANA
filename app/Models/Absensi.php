<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'tb_absensi';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'isHadir',
    ];
}
