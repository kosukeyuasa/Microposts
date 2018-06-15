<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoriteTable extends Migration
{
    
    public function up()
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('favorite_id')->unsigned()->index();
            $table->timestamps();

            
            
            
            $table->unique(['user_id', 'favorite_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite');
    }
}
