<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan',255);
            $table->text('detail_kejadian');
            $table->text('detail_alamat');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('status')->nullable();
            $table->integer('is_public')->nullable();
            $table->text('status_desc')->nullable();
            $table->text('tanggal_kejadian')->nullable();
            $table->text('waktu_kejadian')->nullable();
            $table->text('peyebab_kejadian')->nullable();
            $table->text('kerusakan_bangunan')->nullable();
            $table->text('kerusakan_lain')->nullable();
            $table->text('korban_jiwa')->nullable();
            $table->text('kondisi_korban')->nullable();
            $table->unsignedBigInteger('id_staff')->nullable();
            $table->unsignedBigInteger('id_people')->nullable();
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_staff')->references('id')->on('admins')->onDelete('set null');
            $table->foreign('id_people')->references('id')->on('people')->onDelete('set null');
            $table->foreign('id_category')->references('id')->on('report_categories')->onDelete('set null');
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
        Schema::dropIfExists('reports');
    }
}
