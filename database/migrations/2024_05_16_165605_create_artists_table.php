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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string("coverImage");
            $table->string("artistName");
            $table->text("artistDesc");
            $table->string("show")->default("no");
            $table->string("slug");
            
            $table->unsignedBigInteger("exhibition_id")->nullable();
            $table->foreign("exhibition_id")->references("id")->on("exhibitions")->onDelete("set null");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
