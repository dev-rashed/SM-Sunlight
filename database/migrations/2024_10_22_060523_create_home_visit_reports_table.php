<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeVisitReportsTable extends Migration
{
    public function up()
    {
        Schema::create('home_visit_reports', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number');
            $table->string('customer_name');
            $table->string('mobile_number')->unique();
            $table->string('village_name');
            $table->string('word_number');
            $table->string('union_name');
            $table->string('thana');
            $table->string('district');
            $table->text('home_appliance_have')->nullable();
            $table->text('home_appliance_not_have')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('home_visit_reports');
    }
}
