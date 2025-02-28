<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // Auto-increment Primary Key
            $table->string('teacher_id')->unique(); // Unique Teacher ID
            $table->string('name'); // Full Name
            $table->string('email')->unique(); // Email Address
            $table->string('phone')->nullable(); // Phone Number
            $table->string('gender'); // Gender (Male/Female)
            $table->date('dob')->nullable(); // Date of Birth
            $table->string('blood_group')->nullable(); // Blood Group
            $table->string('nid')->nullable(); // National ID / Passport Number
            $table->text('address')->nullable(); // Home Address
            $table->string('profile_picture')->nullable(); // Profile Picture URL

            // Academic Information
            $table->string('qualification')->nullable(); // Highest Educational Qualification
            $table->string('designation')->nullable(); // Job Designation (e.g., Senior Teacher, Assistant Teacher)
            $table->string('department')->nullable(); // Department (e.g., Science, Arts)
            $table->string('subjects')->nullable(); // JSON format for multiple subjects
            $table->date('joining_date')->nullable(); // Date of Joining the Institution
            $table->decimal('salary', 20, 2)->nullable(); // Salary Amount

            // System & Permissions
            $table->string('username')->unique()->nullable(); // Unique Username for login
            $table->string('password')->nullable(); // Hashed Password
            $table->integer('role_id')->default(0); // Role-based Access (Teacher/Admin)
            $table->json('permissions')->nullable(); // JSON format for system access permissions
            $table->integer('status')->default(1);

            $table->timestamps(); // Created_at and Updated_at timestamps
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers'); // Drop the table if migration is rolled back
    }
};
