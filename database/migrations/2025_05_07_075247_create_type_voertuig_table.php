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
        Schema::create('type_voertuig', function (Blueprint $table) {
            $table->id();
            $table->string('TypeVoertuig', 50);
            $table->string('Rijbewijscategorie', 5);
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
        Schema::dropIfExists('type_voertuig');
    }
};
