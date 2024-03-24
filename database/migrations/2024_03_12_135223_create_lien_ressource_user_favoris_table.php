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
        Schema::create('lien_ressource_user_favoris', function (Blueprint $table) {
            $table->foreignId('id_res')->constrained('ressource');
            $table->foreignId('id_user')->constrained('users');
            $table->primary(['id_res', 'id_user']);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });

        Artisan::call('db:seed', array('--class' => 'LienRessourceUserFavorisSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lien_ressource_user_favoris');
    }
};
