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
        Schema::create('utilise', function (Blueprint $table) {
            $table->integer('nombre_uti');
            $table->dateTime('derniere_uti');
            $table->timestamps();
        });
        Artisan::call('db:seed', array('--class' => 'UtiliseSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilise');
    }
};
