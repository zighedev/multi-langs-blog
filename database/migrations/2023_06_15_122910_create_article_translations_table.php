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
        Schema::create('article_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
		
			$table->bigIncrements('id');
			$table->foreignId('article_id')->constrained()->onDelete('cascade');
			$table->string('locale')->index();
			$table->unique(['article_id', 'locale']);
			$table->string('title', 255)->collation('utf8_general_ci');
			$table->unique(['locale', 'title']);
			$table->text('content')->nullable()->collation('utf8_general_ci');
			$table->string('description', 255)->nullable()->comment('meta tag description')->collation('utf8_general_ci');
			$table->string('image_description', 255)->nullable()->comment('image alt')->collation('utf8_general_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_translations');
    }
};
