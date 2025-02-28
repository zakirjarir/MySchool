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
       Schema::create('attendance', function (Blueprint $table) {
           $table->id();
           $table->string('student_id');
           $table->date('attendance_date');
           $table->time('attendance_time');
           $table->enum('attendance_status', ['present', 'absent', 'late']);
           $table->string('status')->default(1);
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('attendance');
    }
};
