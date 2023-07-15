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
        Schema::create('articles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
			$table->bigIncrements('id');
			$table->string('image', 30)->nullable()->unique();
			$table->integer('views')->default(0);
			$table->tinyInteger('approval')->default(0)->comment('1=>approved, 0=>not approved');
			
			$table->timestamps();
			$table->softDeletes(); 
			
			$table->foreignId('user_id')
			->nullable()
            ->constrained()			
            ->onUpdate('cascade')
            ->onDelete('set null');
			
			$table->foreignId('category_id')
			->nullable()
            ->constrained()
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
        Schema::dropIfExists('articles');
    }
};
