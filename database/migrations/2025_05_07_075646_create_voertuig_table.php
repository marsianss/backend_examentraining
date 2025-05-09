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
        Schema::create('voertuig', function (Blueprint $table) {
            $table->id();
            $table->string('Kenteken', 20)->unique();
            $table->string('Type', 50);
            $table->date('Bouwjaar');
            $table->string('Brandstof', 20);
            $table->foreignId('TypeVoertuigId')->constrained('type_voertuig');
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
        Schema::dropIfExists('voertuig');
    }
};
