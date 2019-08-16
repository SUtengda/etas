<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vats', function (Blueprint $table) {
            $table->bigIncrements('VAT_UID');
            $table->unsignedBigInteger('PAR_UID');
            $table->unsignedBigInteger('CLI_UID');
            $table->dateTime('VAT_月份');
            $table->decimal('VAT_月销计算数据',13,2);
            $table->decimal('VAT_月销审核数据',13,2);
            $table->decimal('VAT_VAT计算数据',13,2);
            $table->decimal('VAT_VAT审核数据',13,2);
            $table->decimal('VAT_VAT实收金额',13,2);
            $table->dateTime('VAT_VAT到帐日期');
            $table->dateTime('VAT_税务网上申报日');
            $table->dateTime('VAT_税务网上付款日');

            $table->foreign('PAR_UID')->references('PAR_UID')->on('partners')
                ->onDelete('no action')->onUpdate('no action');
            $table->foreign('CLI_UID')->references('CLI_UID')->on('clients')
                ->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vats');
    }
}
