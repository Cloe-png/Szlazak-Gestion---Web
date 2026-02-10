<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chantier_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chantier_id')->constrained('chantiers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_by')->constrained('users');
            $table->timestamp('assigned_at')->useCurrent();
            $table->timestamps();

            $table->unique(['chantier_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chantier_user');
    }
};
