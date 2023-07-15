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
        Schema::create('category_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';

            $table->bigIncrements('id');
			$table->foreignId('category_id')->constrained()->onDelete('cascade');
			$table->string('locale')->index();
			$table->unique(['category_id', 'locale']);
            $table->string('name', 255)->collation('utf8_general_ci');
			$table->unique(['locale', 'name']);
			$table->string('description', 255)->nullable()->comment('meta tag description')->collation('utf8_general_ci');
			
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_translations');
    }
};
