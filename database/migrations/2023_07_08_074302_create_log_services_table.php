<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name', 30);
            $table->string('service_type_call', 50);
            $table->integer('status_code');
            $table->dateTime('execute_time');
            // Add Indexes
            $table->index('service_name');
            $table->index('status_code');
            $table->index('execute_time');
            $table->unique(['service_name', 'execute_time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_services');
    }
}
