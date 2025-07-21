<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\BlueprInteger;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home', function (Blueprint $table) {
            $table->id();
            $table->string('section')->nullable();
            $table->string('code')->nullable();
            $table->string('nama')->nullable();
            $table->string('kode_budget')->nullable();
            $table->string('cur')->nullable();
            $table->string('fixed')->nullable();
            $table->string('prep')->nullable();
            $table->string('kode_carline')->nullable();
            $table->string('remark')->nullable();
            $table->Integer('qty_jul')->nullable();
            $table->double('price_jul')->nullable();
            $table->double('amount_jul')->nullable();
            $table->Integer('qty_aug')->nullable();
            $table->double('price_aug')->nullable();
            $table->double('amount_aug')->nullable();
            $table->Integer('qty_sep')->nullable();
            $table->double('price_sep')->nullable();
            $table->double('amount_sep')->nullable();
            $table->Integer('qty_okt')->nullable();
            $table->double('price_okt')->nullable();
            $table->double('amount_okt')->nullable();
            $table->Integer('qty_nov')->nullable();
            $table->double('price_nov')->nullable();
            $table->double('amount_nov')->nullable();
            $table->Integer('qty_dec')->nullable();
            $table->double('price_dec')->nullable();
            $table->double('amount_dec')->nullable();
            $table->Integer('qty_jan')->nullable();
            $table->double('price_jan')->nullable();
            $table->double('amount_jan')->nullable();
            $table->Integer('qty_feb')->nullable();
            $table->double('price_feb')->nullable();
            $table->double('amount_feb')->nullable();
            $table->Integer('qty_mar')->nullable();
            $table->double('price_mar')->nullable();
            $table->double('amount_mar')->nullable();
            $table->Integer('qty_apr')->nullable();
            $table->double('price_apr')->nullable();
            $table->double('amount_apr')->nullable();
            $table->Integer('qty_may')->nullable();
            $table->double('price_may')->nullable();
            $table->double('amount_may')->nullable();
            $table->Integer('qty_jun')->nullable();
            $table->double('price_jun')->nullable();
            $table->double('amount_jun')->nullable();
            $table->string('tahun');
            $table->double('stp_amount_jul')->nullable();
            $table->double('stp_amount_aug')->nullable();
            $table->double('stp_amount_sep')->nullable();
            $table->double('stp_amount_okt')->nullable();
            $table->double('stp_amount_nov')->nullable();
            $table->double('stp_amount_dec')->nullable();
            $table->double('stp_amount_jan')->nullable();
            $table->double('stp_amount_feb')->nullable();
            $table->double('stp_amount_mar')->nullable();
            $table->double('stp_amount_apr')->nullable();
            $table->double('stp_amount_may')->nullable();
            $table->double('stp_amount_jun')->nullable();
            $table->string('role_id');
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
        Schema::dropIfExists('home');
    }
}
