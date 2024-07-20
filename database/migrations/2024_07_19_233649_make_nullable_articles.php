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
        Schema::table('articles', function (Blueprint $table) {
            $table->string("operaName")->nullable()->change();
            $table->string("slug")->nullable()->change();
            $table->string("operaYear")->nullable()->change();
            $table->string("operaMaterial")->nullable()->change();
            $table->text("operaDescription")->nullable()->change();
            $table->string("operaPicture")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string("operaName")->require()->change();
            $table->string("slug")->require()->change();
            $table->string("operaYear")->require()->change();
            $table->string("operaMaterial")->require()->change();
            $table->text("operaDescription")->require()->change();
            $table->string("operaPicture")->require()->change();
        });
    }
};
