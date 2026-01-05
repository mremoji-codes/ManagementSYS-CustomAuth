<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
     Schema::create('leave_requests', function (Blueprint $table) 
     {
        $table->id();
        // Link the request to a specific user (Foreign Key)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // The details of the leave
        $table->string('leave_type'); // e.g., Sick, Vacation, Personal
        $table->date('start_date');
        $table->date('end_date');
        $table->text('reason')->nullable();
        
        // Status: 'pending', 'approved', or 'rejected'
        // We set the default to 'pending' so it waits for the admin
        $table->string('status')->default('pending');
        
        $table->timestamps();
     });
}
};
