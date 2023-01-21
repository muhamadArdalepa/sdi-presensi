<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_details', function (Blueprint $table) {
            $table->foreignId('task_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->datetime('waktu_mulai');
            $table->datetime('waktu_selesai');
            $table->enum('ket', ['Harian', 'Mingguan'])->default('Harian');
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
        Schema::dropIfExists('task_details');
    }
}
