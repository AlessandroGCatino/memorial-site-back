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
        Schema::create('home_pictures', function (Blueprint $table) {
            $table->id();
            $table->string("imagePic")->nullable();
            $table->string("videoUrl")->nullable();
            $table->string("selectedMode")->default('image');
            $table->string("xAxis");
            $table->string("yAxis");
            $table->string("height");
            $table->string("width");
            $table->string("linksTo");
            $table->string("layer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pictures');
    }
};
