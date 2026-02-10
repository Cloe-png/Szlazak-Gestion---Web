<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('nom', 100);
                $table->string('email', 191)->unique();
                $table->string('mot_de_passe');
                $table->foreignId('role_id')->constrained();
                $table->date('date_embauche')->nullable();
                $table->string('telephone', 20)->nullable();
                $table->string('adresse', 500)->nullable();
                $table->timestamps();
            });
        } else {
            // Si la table existe déjà, ajoutez les colonnes manquantes
            Schema::table('users', function (Blueprint $table) {
                if (!Schema::hasColumn('users', 'telephone')) {
                    $table->string('telephone', 20)->nullable()->after('date_embauche');
                }
                if (!Schema::hasColumn('users', 'adresse')) {
                    $table->string('adresse', 500)->nullable()->after('telephone');
                }
            });
        }
    }

    public function down(): void
    {
        // Ne pas supprimer la table dans le down() pour éviter de perdre des données
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'telephone')) {
                    $table->dropColumn('telephone');
                }
                if (Schema::hasColumn('users', 'adresse')) {
                    $table->dropColumn('adresse');
                }
            });
        }
    }
};