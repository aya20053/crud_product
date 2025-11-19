<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
       Schema::create('products', function (Blueprint $table) 
 {
    $table->id();
    $table->string('name');
    $table->integer('price');
    $table->integer('stock');
    $table->string('description');
    $table->string('category');
    $table->boolean('is_active');
    $table->timestamps();
});

    }

    
    public function down(): void
    {
        
    }
};
