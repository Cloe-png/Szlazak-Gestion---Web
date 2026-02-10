<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprunt_equipements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipement_id')->constrained('equipements')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('chantier_id')->nullable()->constrained('chantiers')->nullOnDelete();
            $table->unsignedInteger('quantite')->default(1);
            $table->timestamp('date_emprunt')->useCurrent();
            $table->timestamp('date_retour')->nullable();
            $table->string('statut', 20)->default('pris');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprunt_equipements');
    }
};
