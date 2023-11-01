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
        Schema::create('import_booking',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->string('name');
            $table->string('location');
            $table->string('courier');
            $table->string('phone_courier');
            $table->string('daily_name');
            $table->unsignedBigInteger('user_id');
            $table->integer('status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branch');
            $table->timestamps();




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
