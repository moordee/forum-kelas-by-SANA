<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'tb_jadwal';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'hari',
        'mapel1',
        'mapel2',
        'mapel3',
        'mapel4',
        'mapel5',
        'mapel6',
    ];
}
