<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_fournisseur',
        'adresse',
        'telephone',
        'email',
    ];

    // Un fournisseur fourni plusieurs produits(vis vers ca)
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'fournisseur_produit');
    }
}
