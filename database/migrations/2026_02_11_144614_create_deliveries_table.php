<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // lien avec orders
            $table->string('livreur_nom', 100)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('statut', 50)->default('en attente'); // en route, livré
            $table->timestamps(); // date_livraison
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
