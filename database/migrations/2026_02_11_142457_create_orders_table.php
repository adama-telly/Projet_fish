<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // lien avec users
            $table->integer('total');                       // montant total
            $table->string('statut', 50)->default('en attente'); // en attente, payée, livrée
            $table->string('mode_paiement', 50)->nullable();     // Wave, OM
            $table->timestamps();                          // date_commande
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
