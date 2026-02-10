<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('emprunt_equipements') && !Schema::hasColumn('emprunt_equipements', 'etat_apres_retour')) {
            Schema::table('emprunt_equipements', function (Blueprint $table) {
                $table->string('etat_apres_retour', 50)->nullable()->after('date_retour');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('emprunt_equipements') && Schema::hasColumn('emprunt_equipements', 'etat_apres_retour')) {
            Schema::table('emprunt_equipements', function (Blueprint $table) {
                $table->dropColumn('etat_apres_retour');
            });
        }
    }
};
