<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('balance', 10, 2)->unsigned();
            $table->integer('user_id')->unique()->unsigned();
            // Foreign keys
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            // Laravel default timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
