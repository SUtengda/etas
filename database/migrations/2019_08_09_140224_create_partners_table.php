<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('partners', function (Blueprint $table) {
            $table->bigIncrements('PAR_UID');
            $table->string('PAR_partner',45)->index();
            $table->string('PAR_contact',45);
            $table->string('PAR_address');
            $table->string('PAR_telephone',45)->nullable();
            $table->string('PAR_mobilePhone',45);
            $table->string('PAR_email',45);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
