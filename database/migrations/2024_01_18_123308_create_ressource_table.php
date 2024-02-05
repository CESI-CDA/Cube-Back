<?php

use Database\Seeders\RessourceSeeder;
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
            $table->id('id_res');
            $table->string('titre_res', 40);
            $table->longText('contenu_res');
            $table->longText('url_res')->nullable();
            $table->timestamp('created_at_res')->nullable();
            $table->timestamp('updated_at_res')->nullable();
        });

        Artisan::call('db:seed', array('--class' => 'RessourceSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressources');
    }
};
