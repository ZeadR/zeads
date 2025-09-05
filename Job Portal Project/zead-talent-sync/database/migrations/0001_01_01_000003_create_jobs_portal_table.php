<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs_portal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('salary_min')->nullable();
            $table->unsignedInteger('salary_max')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->text('description');
            $table->timestamps();
            $table->index(['category', 'location', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs_portal');
    }
};
