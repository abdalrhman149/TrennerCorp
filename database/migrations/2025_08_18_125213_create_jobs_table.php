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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // أضفت حقل عنوان الوظيفة

            $table->foreignId('company_id')
                ->nullable() // ضروري لـ onDelete('set null')
                ->constrained('companies')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->string('person_need');
            $table->string('category');
            $table->string('requirements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
