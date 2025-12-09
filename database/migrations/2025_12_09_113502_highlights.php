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
        schema::create('highlights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trek_id');
            $table->string('day');
            $table->text('description');
             $table->foreign('trek_id')
              ->references('id') // references column 'id' in treks
              ->on('treks')
              ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
