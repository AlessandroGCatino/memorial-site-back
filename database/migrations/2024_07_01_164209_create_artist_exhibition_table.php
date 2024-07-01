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
        Schema::create('artist_exhibition', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("artist_id")->required();
            $table->foreign("artist_id")->references("id")->on("artists")->cascadeOnDelete();

            $table->unsignedBigInteger("exhibition_id")->nullable();
            $table->foreign("exhibition_id")->references("id")->on("exhibitions")->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_exhibition');
    }
};
