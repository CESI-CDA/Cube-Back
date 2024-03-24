<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('historique_ressource_user', function (Blueprint $table) {
            $table->foreignId('id_res')->constrained('ressource');
            $table->foreignId('id_user')->constrained('users');
            $table->bigInteger('nombre_consultation')->default(0);
            $table->dateTime('derniere_utilisation')->nullable();
            $table->primary(['id_res', 'id_user']);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_ressource_user');
    }
};
