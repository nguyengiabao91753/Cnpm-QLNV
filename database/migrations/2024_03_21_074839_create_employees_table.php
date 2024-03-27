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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identity_number');
            $table->string('birthday');
            $table->string('email');
            $table->string('phone');
            $table->string('gender');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('salary_level')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();

            $table->foreign('supervisor_id')->references('id')->on('employees');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('salary_level')->references('id')->on('salaries');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
