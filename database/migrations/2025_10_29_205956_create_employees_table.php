<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('sex')->nullable();
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->date('date_started')->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('password'); // password field added
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
