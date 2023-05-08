<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable =[
        'valeur'
    ];
    protected $table = 'images';

    public $timestamps = false;
}
