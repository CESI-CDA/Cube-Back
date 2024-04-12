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
        Schema::create('ressource', function (Blueprint $table) {
            $table->id();
            $table->string('titre_res', 100);
            $table->longText('contenu_res');
            $table->longText('url_res')->nullable();
            $table->foreignId('id_type_res')->constrained('type_ressource');
            $table->foreignId('id_vis')->constrained('visibilite');
            $table->foreignId('id_createur')->constrained('users');
            $table->dateTime('date_creation');
            $table->boolean('is_archive')->default(0);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressources');
    }
};
