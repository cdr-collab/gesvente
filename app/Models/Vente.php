<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = ['client_id', 'montant_total'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produits()
{
    return $this->belongsToMany(Produit::class, 'vente_produit')
                ->withPivot('quantite', 'prix_unitaire', 'sous_total')
                ->withTimestamps();
}

}

