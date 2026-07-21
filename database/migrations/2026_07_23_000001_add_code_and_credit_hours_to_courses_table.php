<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // course_code becomes the real unique identifier for a course
            // (e.g. "CS101"), so the old uniqueness on name is dropped.
            $table->dropUnique(['name']);
            $table->string('course_code')->nullable()->unique()->after('name');
            $table->unsignedTinyInteger('credit_hours')->nullable()->after('course_code');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['course_code', 'credit_hours']);
            $table->unique('name');
        });
    }
};
