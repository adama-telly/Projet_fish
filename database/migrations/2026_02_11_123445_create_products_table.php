<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);           // nom du poisson
            $table->text('description')->nullable(); // description
            $table->integer('prix');              // prix en FCFA
            $table->string('image_url')->nullable(); // URL de l'image
            $table->integer('stock');             // quantité disponible
            $table->string('categorie', 50);      // Frais, Filet, Mariné
            $table->timestamps();                 // date_ajout (created_at + updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
