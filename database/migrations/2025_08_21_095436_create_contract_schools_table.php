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
        Schema::create('contract_schools', function (Blueprint $table) {
            $table->id();
            $table->string('percentage')->nullable();
            $table->string('work_days')->nullable();
            $table->decimal('labor_cost', 12, 2)->default(0);
            $table->decimal('chemical_cost', 12, 2)->default(0);
            $table->string('frequency')->nullable();
             $table->foreignId('contract_id')->constrained('contracts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_schools');
    }
};
