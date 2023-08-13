<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {


    public function up(): void
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('amount', 8, 2);
            $table->foreignId('Grade_id')->constrained('grades');
            $table->foreignId('Classroom_id')->constrained('classrooms');
            $table->string('year');
            $table->string('notes')->nullable();
            $table->integer('fee_type');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
