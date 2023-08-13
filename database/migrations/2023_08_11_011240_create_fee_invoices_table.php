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
        Schema::create('fee_invoices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('Classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();
            $table->foreignId('fee_id')->references('id')->on('fees');
            $table->decimal('amount',8,2);
            $table->string('notes')->default('لايوجد');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_invoices');
    }
};
