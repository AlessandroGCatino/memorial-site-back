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
        Schema::table('home_pictures', function (Blueprint $table) {
            $table->string("imagePic")->nullable()->change();
            $table->string("videoUrl")->nullable();
            $table->string("selectedMode")->default('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_pictures', function (Blueprint $table) {
            $table->dropColumn("videoUrl");
            $table->dropColumn("selectedMode");
            $table->string("imagePic")->nullable(false)->change();
        });
    }
};
