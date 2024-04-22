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
        //
        Schema::create('playtimeorder', function (Blueprint $table) {
            $table->id();
            $table->time('outtime');
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('playtimes_id');
            $table->foreign('playtimes_id')->references('id')->on('playtimes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('playtimeorder');
    }
};
