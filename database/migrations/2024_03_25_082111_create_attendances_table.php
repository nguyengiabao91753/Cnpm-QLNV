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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->tinyInteger('present')->nullable()->default(null);
            $table->tinyInteger('status')->nullable(); //0:vang-1:lam day du-2:lam nua ngay (di tre/ve som)-3:tang ca
            $table->dateTime('clock_in')->nullable()->default(null);
            $table->dateTime('clock_out')->nullable()->default(null);
            $table->boolean('leave_request')->default(false); 
            $table->boolean('leave_approved')->nullable()->default(null);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('work_id')->references('id')->on('work__schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
