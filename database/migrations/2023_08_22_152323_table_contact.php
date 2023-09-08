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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('content');
            $table->integer('type');
            $table->string('phone');
            $table->string('reason');
            $table->timestamp('time_start')->nullable(); 
            $table->timestamp('time_end')->nullable(); 
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->integer('status');
            $table->float('flag')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
