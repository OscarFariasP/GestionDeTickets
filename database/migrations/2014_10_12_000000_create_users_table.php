<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipouser');
            $table->foreign('id_tipouser')->references('id')->on('tipo_usuario')->onDelete('cascade');            
            $table->string('nombre');
            $table->string('email')->unique();        
            $table->string('pass');                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
        
    }
}
