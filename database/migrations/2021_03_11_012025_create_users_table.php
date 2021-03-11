<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('cpf', 11)->unique();
            $table->string('email', 200)->unique();
            $table->string('password', 200);
            $table->integer('role_id')->unsigned();
            // Foreign keys
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
            // Laravel default timestamps
            $table->timestamps();
            // Laravel soft deletes
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
