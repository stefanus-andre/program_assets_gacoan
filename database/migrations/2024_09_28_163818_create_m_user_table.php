<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMUserTable extends Migration
{
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_user');
    }
}

