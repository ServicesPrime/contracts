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
    Schema::create('contracts', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('contract_number')->unique();
        
        // ✅ Relación con client (en lugar de name y location)
        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
        
        $table->string('department'); // Este se mantiene
        
        // ✅ Relación con services (en lugar de product_description)
        $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
        
        $table->integer('product_quantity'); // Se mantiene (o cambiar a quantity)
        $table->decimal('product_cost', 10, 2); // Se mantiene
        $table->date('date'); 
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
