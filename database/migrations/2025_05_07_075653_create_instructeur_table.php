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
        Schema::create('instructeur', function (Blueprint $table) {
            $table->id();
            $table->string('Voornaam', 50);
            $table->string('Tussenvoegsel', 20)->nullable();
            $table->string('Achternaam', 50);
            $table->string('Mobiel', 15)->nullable();
            $table->date('DatumInDienst')->nullable();
            $table->integer('AantalSterren')->nullable();
            $table->boolean('IsActief')->default(true);
            $table->string('Opmerking', 250)->nullable();
            $table->timestamp('DatumAangemaakt', 6)->useCurrent();
            $table->timestamp('DatumGewijzigd', 6)->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructeur');
    }
};
