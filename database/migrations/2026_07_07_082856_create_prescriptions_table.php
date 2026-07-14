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
    Schema::create('prescriptions', function (Blueprint $table) {

        $table->id();

        $table->foreignId('customer_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('doctor_name')->nullable();

        // Right Eye (OD)
        $table->decimal('right_sphere',5,2)->nullable();
        $table->decimal('right_cylinder',5,2)->nullable();
        $table->integer('right_axis')->nullable();

        // Left Eye (OS)
        $table->decimal('left_sphere',5,2)->nullable();
        $table->decimal('left_cylinder',5,2)->nullable();
        $table->integer('left_axis')->nullable();

        $table->decimal('pd',5,2)->nullable();

        $table->decimal('addition',5,2)->nullable();

        $table->text('notes')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
