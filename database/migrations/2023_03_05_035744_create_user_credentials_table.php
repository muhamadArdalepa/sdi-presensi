<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_credentials', function (Blueprint $table) {
            $table->foreignId('user_id') 
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role',['Admin','Pegawai'])->default('Pegawai');
            $table->varchar()
            $table->timestamp('email_verified_at');
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
        Schema::dropIfExists('user_credentials');
    }
}
