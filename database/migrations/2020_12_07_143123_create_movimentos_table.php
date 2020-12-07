<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('tipo',['ENTRADA','SAÍDA']);
            $table->bigInteger('material_id')           ->unsigned();
            $table->bigInteger('funcionario_id')        ->unsigned()->nullable();
            $table->integer('quantidade')               ->default(0);
            $table->timestamps();
        });

        Schema::table('movimentos', function($table){    
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade');      
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentos');
    }
}
