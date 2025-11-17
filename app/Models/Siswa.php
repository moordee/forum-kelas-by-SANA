<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    protected $table = 'tb_siswa';          // your table name
    protected $primaryKey = 'id_siswa';     // your primary key
    public $timestamps = false;             // your table has no timestamps

    protected $fillable = [
        'username',
        'password'
    ];

    protected $hidden = [
        'password'
    ];
}
