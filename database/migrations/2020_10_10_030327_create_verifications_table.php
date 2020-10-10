<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            //VEHICLE DETAILS
            $table->string('type');
            $table->boolean('verified')->default(0);
            $table->foreignId('vehicle_id')->nullable()->index();

            //AXLE SPACING
            $table->integer('front_coupling_axle')->nullable();
            $table->integer('front_a1')->nullable();
            $table->integer('front_coupling_a1')->nullable();
            $table->integer('a1a2')->nullable();
            $table->integer('a2a3')->nullable();
            $table->integer('a3a4')->nullable();
            $table->integer('a4a5')->nullable();
            $table->integer('a5a6')->nullable();
            $table->integer('a6a7')->nullable();
            $table->integer('a7a8')->nullable();
            $table->integer('a8a9')->nullable();
            $table->integer('a9a10')->nullable();
            $table->integer('a10a11')->nullable();
            $table->integer('a11a12')->nullable();

            //RATINGS
            $table->integer('gvm')->nullable();
            $table->integer('gcm')->nullable();
            $table->integer('faxle_rating')->nullable();
            $table->integer('raxle_rating')->nullable();
            $table->integer('front_coupling')->nullable();
            $table->integer('rear_coupling')->nullable();
            $table->integer('mtm_braked')->nullable();
            $table->integer('mtm_unbraked')->nullable();

            //TARE WEIGHT
            $table->integer('kingpin_downforce')->nullable();
            $table->integer('axle1')->nullable();
            $table->integer('axle2')->nullable();
            $table->integer('axle3')->nullable();
            $table->integer('axle4')->nullable();
            $table->integer('axle5')->nullable();
            $table->integer('axle6')->nullable();
            $table->integer('axle7')->nullable();
            $table->integer('axle8')->nullable();
            $table->integer('axle9')->nullable();
            $table->integer('axle10')->nullable();
            $table->integer('axle11')->nullable();
            $table->integer('axle12')->nullable();
            $table->integer('overall')->nullable();

            //RUCS
            $table->integer('ruc_weight')->nullable();
            $table->integer('distance_weight')->nullable();
            $table->integer('add_weight')->nullable();
            $table->integer('permit_weight')->nullable();

            //DIMENSIONS
            $table->integer('wheelbase')->nullable();
            $table->integer('front_overhang')->nullable();
            $table->integer('rear_overhang')->nullable();
            $table->integer('height')->nullable();
            $table->integer('width')->nullable();
            $table->integer('forward_dist')->nullable();
            $table->integer('deck_length')->nullable();
            $table->integer('an_rear_deck')->nullable();

            //TYRE SIZING
            $table->string('tyre_a1')->nullable();
            $table->string('tyre_a2')->nullable();
            $table->string('tyre_a3')->nullable();
            $table->string('tyre_a4')->nullable();
            $table->string('tyre_a5')->nullable();
            $table->string('tyre_a6')->nullable();
            $table->string('tyre_a7')->nullable();
            $table->string('tyre_a8')->nullable();
            $table->string('tyre_a9')->nullable();
            $table->string('tyre_a10')->nullable();
            $table->string('tyre_a11')->nullable();
            $table->string('tyre_a12')->nullable();

            //AXLE TYPE
            $table->enum('axle_a1', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a2', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a3', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a4', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a5', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a6', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a7', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a8', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a9', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a10', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a11', ['S', 'T', '4', '8'])->nullable();
            $table->enum('axle_a12', ['S', 'T', '4', '8'])->nullable();

            //AXLE SET TYPE
            $table->enum('axle_set_a1', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a2', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a3', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a4', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a5', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a6', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a7', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a8', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a9', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a10', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a11', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();
            $table->enum('axle_set_a12', ['In', 'T', 'Tri', 'TS', 'Q'])->nullable();

            //SUSPENSION
            $table->string('suspension_a1')->nullable();
            $table->string('suspension_a2')->nullable();
            $table->string('suspension_a3')->nullable();
            $table->string('suspension_a4')->nullable();
            $table->string('suspension_a5')->nullable();
            $table->string('suspension_a6')->nullable();
            $table->string('suspension_a7')->nullable();
            $table->string('suspension_a8')->nullable();
            $table->string('suspension_a9')->nullable();
            $table->string('suspension_a10')->nullable();
            $table->string('suspension_a11')->nullable();
            $table->string('suspension_a12')->nullable();

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
        Schema::dropIfExists('verifications');
    }
}
