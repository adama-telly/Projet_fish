<?php

namespace App\Models;

use App\Enums\PoissonCategorie;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'nom',
        'description',
        'prix',
        'image_url',
        'stock',
        'categorie',
    ];

    // Scopes pour récupérer les produits par catégorie
    public function scopeSimple($query)
    {
        return $query->where('categorie', PoissonCategorie::SIMPLE);
    }

    public function scopeEcailler($query)
    {
        return $query->where('categorie', PoissonCategorie::ECAILLER);
    }

    public function scopeEcaillerMariner($query)
    {
        return $query->where('categorie', PoissonCategorie::ECAILLER_MARINER);
    }

    public function scopeRouge($query)
    {
        return $query->where('categorie', PoissonCategorie::ROUGE);
    }

    public function scopeDorade($query)
    {
        return $query->where('categorie', PoissonCategorie::DORADE);
    }

    public function scopeCoryphene($query)
    {
        return $query->where('categorie', PoissonCategorie::CORYPHENE);
    }
}
