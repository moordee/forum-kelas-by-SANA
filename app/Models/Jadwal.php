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
        'mapel',
        'jam_mulai',
    ];
}
