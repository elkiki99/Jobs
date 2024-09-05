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
        Schema::create('user_cvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->text('profile_summary')->nullable();
            $table->json('education')->nullable();
            $table->json('work_experience')->nullable();
            $table->json('skills')->nullable();
            $table->json('certifications')->nullable();
            $table->json('languages')->nullable();
            $table->json('projects')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cvs');
    }
};
