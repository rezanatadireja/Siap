<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateJenisPengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_pengaduan_id')->constrained('bidang_pengaduans')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('sub_bidang_id')->constrained('sub_bidangs')->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama');
            $table->string('kuota')->nullable();
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
        Schema::dropIfExists('jenis_pengaduans');
    }
}
