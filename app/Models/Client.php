<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    // Champs qui peuvent être remplis
    protected $fillable = [
        'nom_client',
        'adresse',
        'telephone',
        'email',
    ];
}
