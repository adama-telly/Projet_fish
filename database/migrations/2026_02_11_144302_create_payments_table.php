<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // lien avec orders
            $table->integer('montant');
            $table->string('reference', 100)->nullable(); // Ref Wave/OM
            $table->string('statut', 50)->default('en attente'); // succès, échec
            $table->timestamps(); // date_paiement
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
