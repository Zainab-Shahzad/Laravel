<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Name column
            $table->string('father_name'); // Father name column
            $table->string('roll_no')->unique(); // Unique Roll Number column
            $table->string('phone'); // Unique Roll Number column
            $table->string('address'); // Address column
            $table->string('department'); // Department column
            $table->timestamps(); // Created at and Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}

