<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student_concerns', function (Blueprint $table) {
            $table->id();
            $table->text('concern');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_concerns');
    }

};
