<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->bigIncrements('CLI_UID');
            $table->unsignedBigInteger('PAR_UID');
            $table->string('CLI_内部编号',45)->nullable();
            $table->string('CLI_名称',45)->charset('big5')->nullable();
            $table->string('CLI_法国公司号',45)->nullable();
            $table->string('CLI_中国地址',200)->charset('big5')->nullable();
            $table->string('CLI_联系方式',45)->charset('big5')->nullable();
            $table->decimal('CLI_报价',11,2)->nullable();
            $table->decimal('CLI_首付金额',11,2)->nullable();
            $table->dateTime('CLI_首付到帐日')->nullable();
            $table->decimal('CLI_余款金额',11,2)->nullable();
            $table->dateTime('CLI_余款到帐日')->nullable();
            $table->decimal('CLI_汇率或手续费损失',11,2)->nullable();
            $table->dateTime('CLI_要求税号生效日')->nullable();
            $table->tinyInteger('CLI_要求EROI')->nullable();
            $table->dateTime('CLI_有效材料到达日')->nullable();
            $table->dateTime('CLI_提交税务日')->nullable();
            $table->dateTime('CLI_INSEE建档日')->nullable();
            $table->dateTime('CLI_VAT号下发日')->nullable();
            $table->dateTime('CLI_EROI申请日')->nullable();
            $table->dateTime('CLI_SIE网上申请日')->nullable();
            $table->dateTime('CLI_SIE网上开通日')->nullable();
            $table->dateTime('CLI_银行划帐开通日')->nullable();
            $table->dateTime('CLI_首次申报月')->nullable();
            $table->foreign('PAR_UID')->references('PAR_UID')->on('partners')
                ->onDelete('no action')->onUpdate('no action');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
