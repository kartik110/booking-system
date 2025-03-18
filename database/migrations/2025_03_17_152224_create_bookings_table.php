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
            $table->foreignId('user_id')->constrained()->index();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->date('booking_date')->index();
            $table->enum('type', ['full_day', 'half_day', 'custom']);
            $table->enum('slot', ['first_half', 'second_half'])->nullable();
            $table->time('start_time')->nullable()->index();
            $table->time('end_time')->nullable()->index();
            $table->timestamps();
            
            // Composite index for common query patterns
            $table->index(['booking_date', 'type']);
            $table->index(['booking_date', 'start_time']);
            $table->index(['booking_date', 'end_time']);
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
