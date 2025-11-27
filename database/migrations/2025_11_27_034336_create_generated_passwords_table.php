<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneratedPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generated_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('password'); // La contraseña generada
            $table->integer('length');  // Longitud
            $table->timestamps();       // Fecha de creación
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generated_passwords');
    }
}
