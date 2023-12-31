<?php

use App\Models\branch;
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
        Schema::create('products',function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('price')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('import_price')->nullable();
            $table->integer('status')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branch');
            $table->foreign('category_id')->references('id')->on('category');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
