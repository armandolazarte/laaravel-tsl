<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
             $table->string('job_ref');
             $table->text('job_description')->nullable();
             $table->string('address')->nullable();
             $table->string('suburb')->nullable();
             $table->string('city')->nullable();
             $table->enum('active', ['Active', 'Inactive'])->default('Active');
             $table->enum('status', ['New', 'In Progress', 'Pending', 'Completed'])->default('New');
             $table->integer('total_cost');
             $table->integer('revenue');
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
        Schema::dropIfExists('jobs');
    }
}
