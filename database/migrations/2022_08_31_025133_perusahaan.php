<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Perusahaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('unit_id');
            $table->string('nik');
            $table->string('name');
            $table->string('position_name');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('created_at')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        // Schema::create('karyawan_unit_kerja', function (Blueprint $table) {
        //     $table->unsignedBigInteger('karyawan_id');
        //     $table->unsignedBigInteger('unit_kerja_id');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
