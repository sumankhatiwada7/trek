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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('trek_id');
            $table->date('booking_date');
            $table->integer('number_of_people');
            $table->text('additional_infromation')->nullable();
            $table->enum('status',['pending','accepted','rejected','cancelled'])->default(('pending'));
            $table->timestamps();

            $table->foreign('trek_id')->references('id')->on('treks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
