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
        Schema::create('treks', function (Blueprint $table) {
            $table->id();
            $table->string('trekname');
            $table->string('region');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('price');
            $table->string('tagline');
            $table->string('difficultylevel');
            $table->string('duration');
            $table->string('group_size');
            $table->text('description')->nullable();
            $table->string('elevation');
            $table->string('season');
           
            $table->text('map_route')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treks');
    }
};
