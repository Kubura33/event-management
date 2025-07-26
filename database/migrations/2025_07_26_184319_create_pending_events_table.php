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
        Schema::create('pending_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Step 1 - Overview
            $table->string('title')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->json('tags')->nullable();
            $table->string('image_path')->nullable();

            // Steps 2-4 stored as JSON
            $table->json('schedules')->nullable();
            $table->json('speakers')->nullable();
            $table->json('faqs')->nullable();

            // Tracking
            $table->string('current_step')->default('overview');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_events');
    }
};
