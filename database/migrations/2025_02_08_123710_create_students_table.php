<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Student_id');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('address')->nullable();
            $table->string('photo')->nullable(); // Image path


            $table->string('roll_no')->unique();
            $table->string('class')->nullable();
            $table->string('section')->nullable();
            $table->string('admission_no')->unique();
            $table->date('admission_date');
            $table->string('blood_group')->nullable();


            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->text('guardian_address')->nullable();

            $table->string('status')->default(1);

            $table->text('fingerprint_template')->nullable();
            $table->string('rfid_card_number')->nullable()->unique();


            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('students');
    }
};
