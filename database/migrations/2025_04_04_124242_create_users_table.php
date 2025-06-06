<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('school_id', 15);
            $table->string('email');
            $table->string('phone', 15);
            $table->string('password');
            $table->enum('role', ['user', 'admin']);
            $table->rememberToken();
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('users');
    }
}


