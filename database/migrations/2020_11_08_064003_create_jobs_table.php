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
            $table->foreignId('client_id')->nullable()->constrained('clients');
            $table->string('address')->nullable();
            $table->string('suburb')->nullable();
            $table->string('city')->nullable();
            $table->enum('active', ['Active', 'Inactive'])->default('Active');
            $table->enum('status', ['To be Scheduled', 'In Progress', 'Practically Complete', 'Completed'])->default('To be Scheduled');
            $table->foreignId('project-manager_id')->nullable()->constrained('staff');
            $table->foreignId('job-manager_id')->nullable()->constrained('staff');
            $table->foreignId('acc-manager_id')->nullable()->constrained('staff');
            $table->enum('status', ['Administration', 'Non Stock Location', 'Productive Jobs', 'Completed'])->nullable();
            $table->enum('status', ['Claim Schedule', 'Internal', 'No Charge', 'Quoted'])->nullable();
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
