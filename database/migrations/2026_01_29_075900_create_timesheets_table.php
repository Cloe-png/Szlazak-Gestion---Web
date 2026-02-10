<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('chantier_id')->constrained()->onDelete('cascade');
            $table->string('mois', 20);
            $table->string('jour', 20);
            $table->date('date_travail');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->boolean('pause')->default(false);
            $table->decimal('heures_supp', 5, 2)->default(0);
            $table->timestamps();
            
            $table->index(['date_travail', 'user_id']);
            $table->index('mois');
        });

        // Ajouter la colonne tarif à la table chantiers
        Schema::table('chantiers', function (Blueprint $table) {
            $table->decimal('tarif', 10, 2)->nullable()->after('statut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timesheets');
        
        Schema::table('chantiers', function (Blueprint $table) {
            $table->dropColumn('tarif');
        });
    }
};