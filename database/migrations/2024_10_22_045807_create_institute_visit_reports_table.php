<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituteVisitReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institute_visit_reports', function (Blueprint $table) {
            $table->id('serial_number'); // Auto-incremented primary key
            $table->string('institute_name');
            $table->string('institute_location');
            $table->string('teachers_name');
            $table->string('teachers_mobile_number')->unique();
            $table->integer('teachers_quantity');
            $table->integer('students_quantity');
            $table->text('home_appliance_have')->nullable(); // Optional field
            $table->text('home_appliance_dont_have')->nullable(); // Optional field
            $table->text('remarks')->nullable(); // Optional field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('institute_visit_reports');
    }
}

