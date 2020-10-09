<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            //VEHICLE DETAILS
            $table->string('rego')->unique();
            $table->string('make');
            $table->string('model');
            $table->string('type');
            $table->string('vin')->unique();;
            $table->boolean('verified');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');
            $table->boolean('active')->default(1);

            //AXLE SPACING
            $table->integer('front_a1');
            $table->integer('front_coupling');
            $table->integer('front_coupling_a1');
            $table->integer('a1a2');
            $table->integer('a2a3');
            $table->integer('a3a4');
            $table->integer('a4a5');
            $table->integer('a5a6');
            $table->integer('a6a7');
            $table->integer('a7a8');
            $table->integer('a8a9');
            $table->integer('a9a10');
            $table->integer('a10a11');
            $table->integer('a11a12');

            //RATINGS
            $table->integer('gvm');
            $table->integer('gcm');
            $table->integer('faxle_rating');
            $table->integer('raxle_rating');
            $table->integer('front_coupling');
            $table->integer('rear_coupling');
            $table->integer('mtm_braked');
            $table->integer('mtm_unbraked');

            //TARE WEIGHT
            $table->integer('kingpin_downforce');
            $table->integer('axle1');
            $table->integer('axle2');
            $table->integer('axle3');
            $table->integer('axle4');
            $table->integer('axle5');
            $table->integer('axle6');
            $table->integer('axle7');
            $table->integer('axle8');
            $table->integer('axle9');
            $table->integer('axle10');
            $table->integer('axle11');
            $table->integer('axle12');
            $table->integer('overall');

            //RUCS
            $table->integer('ruc_weight');
            $table->integer('distance_weight');
            $table->integer('add_weight');
            $table->integer('permit_weight');

            //DIMENSIONS
            $table->integer('wheelbase');
            $table->integer('front_overhang');
            $table->integer('rear_overhang');
            $table->integer('height');
            $table->integer('width');
            $table->integer('forward_dist');
            $table->integer('deck_length');
            $table->integer('an_rear_deck');

            //TYRE SIZING
            $table->string('tyre_a1');
            $table->string('tyre_a2');
            $table->string('tyre_a3');
            $table->string('tyre_a4');
            $table->string('tyre_a5');
            $table->string('tyre_a6');
            $table->string('tyre_a7');
            $table->string('tyre_a8');
            $table->string('tyre_a9');
            $table->string('tyre_a10');
            $table->string('tyre_a11');
            $table->string('tyre_a12');

            //AXLE TYPE
            $table->enum('axle_a1', ['S', 'T', '4', '8']);
            $table->enum('axle_a2', ['S', 'T', '4', '8']);
            $table->enum('axle_a3', ['S', 'T', '4', '8']);
            $table->enum('axle_a4', ['S', 'T', '4', '8']);
            $table->enum('axle_a5', ['S', 'T', '4', '8']);
            $table->enum('axle_a6', ['S', 'T', '4', '8']);
            $table->enum('axle_a7', ['S', 'T', '4', '8']);
            $table->enum('axle_a8', ['S', 'T', '4', '8']);
            $table->enum('axle_a9', ['S', 'T', '4', '8']);
            $table->enum('axle_a10', ['S', 'T', '4', '8']);
            $table->enum('axle_a11', ['S', 'T', '4', '8']);
            $table->enum('axle_a12', ['S', 'T', '4', '8']);

            //AXLE SET TYPE
            $table->enum('axle_set_a1', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a2', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a3', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a4', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a5', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a6', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a7', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a8', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a9', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a10', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a11', ['In', 'T', 'Tri', 'TS', 'Q']);
            $table->enum('axle_set_a12', ['In', 'T', 'Tri', 'TS', 'Q']);

            //SUSPENSION
            $table->string('suspension_a1');
            $table->string('suspension_a2');
            $table->string('suspension_a3');
            $table->string('suspension_a4');
            $table->string('suspension_a5');
            $table->string('suspension_a6');
            $table->string('suspension_a7');
            $table->string('suspension_a8');
            $table->string('suspension_a9');
            $table->string('suspension_a10');
            $table->string('suspension_a11');
            $table->string('suspension_a12');

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
        Schema::dropIfExists('vehicles');
    }
}
