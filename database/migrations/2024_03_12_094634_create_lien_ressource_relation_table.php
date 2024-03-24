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
        Schema::create('lien_ressource_relation', function (Blueprint $table) {
            $table->foreignId('id_res')->constrained('ressource');
            $table->foreignId('id_rel')->constrained('relation');
            $table->primary(['id_res', 'id_rel']);
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });

        Artisan::call('db:seed', array('--class' => 'LienRessourceRelationSeeder'));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lien_ressource_relation');
    }
};
