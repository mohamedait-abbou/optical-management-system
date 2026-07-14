<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void

    {

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete(); 

            $table->string('invoice_number', 50)->unique();
            $table->date('issue_date');
            $table->decimal('tax_rate', 5, 2)->default(20.00);
            $table->decimal('total_ht', 10, 2);
            $table->decimal('total_ttc', 10, 2); 


            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};