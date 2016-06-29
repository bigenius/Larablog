<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table -> integer('user_id') -> unsigned() ->default(0);
			$table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
			$table->string('title');
			$table->text('body');
			$table->string('slug')->unique();
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
        Schema::drop('posts');
    }
}
