<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::truncate();

        Product::create([
            'nom' => 'Poisson rouge',
            'description' => 'Poisson rouge frais, idéal pour aquarium ou préparation.',
            'prix en FCFA' => 100,
            'image_url' => '/images/poisson2.jpeg',
            'stock en kg' => 12,
            'categorie' => 'Frais',
        ]);

        Product::create([
            'nom' => 'Thon frais',
            'description' => 'Thon rouge pêché ce matin, filets disponibles.',
            'prix en FCFA' => 3500,
            'image_url' => '/images/Tilapia.jpeg',
            'stock en kg' => 8,
            'categorie' => 'Frais',
        ]);

        Product::create([
            'nom' => 'Loup',
            'description' => 'Loup de mer frais, poisson blanc savoureux.',
            'prix' => 4200,
            'image_url' => '/images/Loup.jpeg',
            'stock en kg' => 12,
            'categorie' => 'Frais',
        ]);

        Product::create([
            'nom' => 'Filet de cabillaud',
            'description' => 'Filet de cabillaud blanc, chair ferme.',
            'prix en FCFA' => 3000,
            'image_url' => '/images/Cafague.jpeg',
            'stock en kg' => 10,
            'categorie' => 'Filet',
        ]);

        Product::create([
            'nom' => 'Bar saumon crevette',
            'description' => 'Bar accompagné de saumon et crevettes frais.',
            'prix en FCFA' => 5000,
            'image_url' => '/images/Bar_saumon_crevette.jpeg',
            'stock en kg' => 5,
            'categorie' => 'Frais',
        ]);

        Product::create([
            'nom' => 'Black bass',
            'description' => 'Black bass savoureux, pêche du jour.',
            'prix en FCFA' => 2800,
            'image_url' => '/images/Black-bass.jpeg',
            'stock en kg' => 14,
            'categorie' => 'Frais',
        ]);

        Product::create([
            'nom' => 'Goujon',
            'description' => 'Petits goujons frais, parfaits pour frire.',
            'prix en FCFA' => 1500,
            'image_url' => '/images/Goujon.jpeg',
            'stock en kg' => 15,
            'categorie' => 'Frais',
        ]);
    }
}
