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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('gender_id')->constrained('genders')->cascadeOnDelete();
            $table->foreignId('blood_id')->constrained('bloods')->cascadeOnDelete();
            $table->foreignId('nationalitie_id')->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('Classroom_id')->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId('parent_id')->constrained('my_parents')->cascadeOnDelete();
            $table->foreignId('Grade_id')->constrained('grades')->cascadeOnDelete();

            $table->date('Date_Birth');
            $table->string('academic_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
