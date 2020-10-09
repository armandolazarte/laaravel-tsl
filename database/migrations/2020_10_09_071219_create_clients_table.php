<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('id');
            $table->string('client');
            $table->string('client_type');
            $table->string('billing_address');
            $table->string('billing_city');
            $table->string('billing_region');
            $table->string('billing_post_code');
            $table->string('main_contact_name');
            $table->string('main_contact_phone');
            $table->string('main_contact_email');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('clients');
    }
}
