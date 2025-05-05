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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->year('release_year')->nullable();
            $table->integer('duration')->nullable(); // duration of the movie in minutes
            $table->string('picture')->nullable();
            $table->enum('rating', ['all ages', 'kids', 'teens', 'adults'])->default('all ages');
            $table->enum('status', ['released', 'unreleased', 'cancelled'])->default('released');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('genre_movie');
    }
};
