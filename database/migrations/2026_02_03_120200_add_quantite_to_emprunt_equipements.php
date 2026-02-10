<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('emprunt_equipements') && !Schema::hasColumn('emprunt_equipements', 'quantite')) {
            Schema::table('emprunt_equipements', function (Blueprint $table) {
                $table->unsignedInteger('quantite')->default(1)->after('chantier_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('emprunt_equipements') && Schema::hasColumn('emprunt_equipements', 'quantite')) {
            Schema::table('emprunt_equipements', function (Blueprint $table) {
                $table->dropColumn('quantite');
            });
        }
    }
};
