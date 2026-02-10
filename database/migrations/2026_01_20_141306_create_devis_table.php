<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisTable extends Migration
{
    public function up()
    {
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client', 100);
            $table->string('email', 191)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->text('description')->nullable();
            $table->string('statut', 50)->default('En attente');
            $table->timestamp('date_reception')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('devis');
    }
}
