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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->default('user');
            $table->string('role_id')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->default(1);
            $table->string('otp')->nullable();
            $table->string('otp_expiry')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_2fa_enabled')->default(false);
            $table->boolean('is_suspended')->default(false);
            $table->string('locale')->default('en');
            $table->boolean('email_notifications')->default(true);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
