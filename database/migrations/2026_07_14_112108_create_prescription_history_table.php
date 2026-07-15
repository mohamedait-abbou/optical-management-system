<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescription_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users'); // Optician who created it
            $table->date('examination_date');
            
            // OD (Right Eye / Œil Droit)
            $table->decimal('od_sphere', 5, 2)->nullable(); // -20.00 to +20.00
            $table->decimal('od_cylinder', 5, 2)->nullable(); // Astigmatism
            $table->integer('od_axis')->nullable(); // 0-180 degrees
            $table->decimal('od_addition', 4, 2)->nullable(); // For progressive lenses
            $table->decimal('od_pd', 4, 1)->nullable(); // Pupillary distance OD
            
            // OG (Left Eye / Œil Gauche)
            $table->decimal('og_sphere', 5, 2)->nullable();
            $table->decimal('og_cylinder', 5, 2)->nullable();
            $table->integer('og_axis')->nullable();
            $table->decimal('og_addition', 4, 2)->nullable();
            $table->decimal('og_pd', 4, 1)->nullable();
            
            // Total PD
            $table->decimal('pd_total', 4, 1)->nullable();
            
            // Vision type
            $table->string('vision_type')->default('distance'); // distance, near, progressive
            $table->text('notes')->nullable();
            $table->text('diagnosis')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prescription_history');
    }
};