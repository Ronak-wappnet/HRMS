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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('subject');
            $table->text('description');
            $table->date('start_day');
            $table->enum('start_day_leave_type',['Half Day','Full Day'])->default('Full Day');
            $table->date('end_date'); 
            $table->enum('end_day_leave_type',['Half Day','Full Day'])->default('Full Day');     
            $table->text('reason');                
            $table->enum('status',['approved','pending'])->default('pending');
            $table->string('Reliver_work');
            $table->integer('leave_balance')->default(4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
