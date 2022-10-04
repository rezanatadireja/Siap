<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                        ->references('id')
                        ->on('users')
                            ->onUpdate('cascade')
                            ->onDelete('restrict');
            $table->unsignedBigInteger('jenis_pengaduan_id')
                        ->references('id')
                        ->on('jenis_pengaduans')
                            ->onUpdate('cascade')
                            ->onDelete('restrict');
            $table->string('no_pengaduan');
            $table->string('detail');
            $table->string('status');
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
        Schema::dropIfExists('pengaduans');
    }
}
