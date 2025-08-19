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
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'dob')) {
            $table->date('dob')->nullable();
        }
        if (!Schema::hasColumn('users', 'gender')) {
            $table->string('gender')->nullable();
        }
        if (!Schema::hasColumn('users', 'address')) {
            $table->string('address')->nullable();
        }
        if (!Schema::hasColumn('users', 'phone')) {
            $table->string('phone')->nullable();
        }
        if (!Schema::hasColumn('users', 'program')) {
            $table->string('program')->nullable();
        }
        if (!Schema::hasColumn('users', 'year_level')) {
            $table->string('year_level')->nullable();
        }
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'dob')) {
            $table->dropColumn('dob');
        }
        if (Schema::hasColumn('users', 'gender')) {
            $table->dropColumn('gender');
        }
        if (Schema::hasColumn('users', 'address')) {
            $table->dropColumn('address');
        }
        if (Schema::hasColumn('users', 'phone')) {
            $table->dropColumn('phone');
        }
        if (Schema::hasColumn('users', 'program')) {
            $table->dropColumn('program');
        }
        if (Schema::hasColumn('users', 'year_level')) {
            $table->dropColumn('year_level');
        }
    });
}
};
