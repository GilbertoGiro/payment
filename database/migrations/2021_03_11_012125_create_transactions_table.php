<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->decimal('amount', 10, 2)->unsigned();
            $table->timestamp('date');
            // Foreign keys
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types');
            // Index
            $table->index('date', 'transaction_date');
            $table->index(['date', 'transaction_type_id'], 'transaction_date_and_type');
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
        Schema::dropIfExists('transactions');
    }
}
