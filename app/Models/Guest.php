<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nama',
        'status_hadir',
        'ucapan',
        'plusone',
        'link_undangan',
    ];
}
