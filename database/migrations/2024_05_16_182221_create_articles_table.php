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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("operaName");
            $table->string("slug");
            $table->string("operaYear");
            $table->string("operaMaterial");
            $table->text("operaDescription");
            $table->string("operaPicture");
            $table->string("show")->default("no");


            $table->unsignedBigInteger("artist_id")->nullable();
            $table->foreign("artist_id")->references("id")->on("artists")->onDelete("set null");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
