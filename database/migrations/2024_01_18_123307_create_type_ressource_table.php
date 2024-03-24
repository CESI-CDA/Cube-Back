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
        Schema::create('type_ressource', function (Blueprint $table) {
            $table->id();
            $table->string('intitule_type_res', 30);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });

        Artisan::call('db:seed', array('--class' => 'TypeRessourceSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_ressource');
    }
};
