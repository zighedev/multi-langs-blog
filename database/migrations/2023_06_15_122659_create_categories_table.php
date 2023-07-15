<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigIncrements('id');
			$table->tinyInteger('visibility')->default(0)->comment('0=>invisible, 1=>visible');
			$table->tinyInteger('ads')->default(1)->comment('0=>Not allowed, 1=>Is allowed');            
            $table->timestamps();
			
			$table->foreignId('parent')
			->nullable()
            ->constrained('categories', 'id')			
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
