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
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigIncrements('id');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('youtube')->nullable();
			$table->string('facebook')->nullable(); 
			$table->string('instagram')->nullable(); 
			$table->string('twitter')->nullable(); 
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
        Schema::dropIfExists('settings');
    }
};
