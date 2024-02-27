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
        Schema::create('visibilite', function (Blueprint $table) {
            $table->id();
            $table->string('intitule_vis', 30);
            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'VisibiliteSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visibilite');
    }
};
