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
        Schema::create('lien_ressource_commentaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_res')->constrained('ressource');
            $table->foreignId('id_user')->constrained('users');
            $table->dateTime('date');
            $table->longText('commentaire');
            $table->foreignId('id_commentaire_parent')->nullable()->constrained('lien_ressource_commentaire');
            $table->foreignId('id_etat')->constrained('etat');
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lien_ressource_commentaire');
    }
};
