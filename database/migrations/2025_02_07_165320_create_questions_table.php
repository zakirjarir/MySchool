<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('subject_id')->nullable();
            $table->text('question_text');
            $table->json('options');
            $table->string('correct_answer', 255);
            $table->integer('status')->default(1);
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};
