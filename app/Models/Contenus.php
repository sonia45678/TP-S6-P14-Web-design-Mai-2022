<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Contenus extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre',
        'description',
        'texte',
        'images',
        'idAuteur'
    ];
    
    protected $casts = [
        'texte' => 'html',
    ];
    
    public function auteur()
    {
        return $this->belongsTo(Auteur::class, 'idAuteur');
    }

    protected $table = 'contenus';

    public $timestamps = false;
}
