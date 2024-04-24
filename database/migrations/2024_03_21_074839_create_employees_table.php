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
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('salary_level')->nullable();
          

            $table->foreign('supervisor_id')->references('id')->on('employees');
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('salary_level')->references('id')->on('salaries');
            

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
