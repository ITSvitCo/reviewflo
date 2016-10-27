<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewfloTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('role_name', 45)->unique();
        });
        
        Schema::create('users', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('name', 120);
            $table->string('email', 45)->unique();
            $table->string('password', 255);
            $table->boolean('active')->default(FALSE);
            $table->foreign('role_id')->references('id')->on('roles');
        });
        
        Schema::create('type_links', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('type', 45)->unique();
        });
        
        Schema::create('following_links', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('type_link_id')->unsigned();
            $table->string('link', 255);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_link_id')->references('id')->on('type_links');
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
        
        Schema::drop('following_links');
        Schema::drop('type_links');
        Schema::drop('users');
        Schema::drop('roles');
        
        
    }
}
