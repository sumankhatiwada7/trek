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
            $table->string('difficultylevel');
            $table->string('duration');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->text('description')->nullable();
            $table->string('image_url');
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
