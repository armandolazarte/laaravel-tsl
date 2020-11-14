<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('job_id')->constrained('jobs');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->string('description');
            $table->string('part_code');
            $table->string('purchase_code');
            $table->decimal('quantity');
            $table->string('unit');
            $table->decimal('item_cost');
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
        Schema::dropIfExists('transaction_items');
    }
}
