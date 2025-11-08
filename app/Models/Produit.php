<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_produit',
        'prix_unitaire',
        'quantite_stock',
        'categorie_id',
        'description',
    ];

    // Relation avec Catégorie
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }
}
