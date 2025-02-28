<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('parent_id');
            $table->string('email')->unique();
            $table->string('username')->nullable();
            $table->string('phone')->unique();
            $table->text('address')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->default(1);
            $table->string('student_id');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('parents');
    }
};
