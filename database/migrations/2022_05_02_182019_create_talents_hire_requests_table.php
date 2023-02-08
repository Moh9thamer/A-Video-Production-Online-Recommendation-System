<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talents_hire_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('project_title');
            $table->string('project_desc');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_price');
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
        Schema::dropIfExists('talents_hire_requests');
    }
};
