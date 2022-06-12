<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id')->nullable();
            $table->string('responder')->nullable();
            $table->text('response')->nullable();
            $table->string('path')->nullable();
            $table->string('status_label')->nullable();
            $table->string('status_code')->nullable();
            $table->foreign('report_id')->references('id')->on('report_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Status Code Desc
     * 0 : Menunggu Diproses
     * 1 : Sedang Diproses
     * 2 : Dalam Koordinasi
     * 3 : Selesai
     * 4 : Ditolak
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
