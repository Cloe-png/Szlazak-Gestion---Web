<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiersTable extends Migration
{
    public function up()
    {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('adresse');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->foreignId('responsable_id')->constrained('users');
            $table->string('statut', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chantiers');
    }
}
