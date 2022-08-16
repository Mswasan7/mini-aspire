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
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->char('guid', 36)->unique()->index()->nullable();
            $table->double('total_payable_amount', 10,2)->nullable();
            $table->double('total_paid_amount', 10,2)->nullable();
            $table->timestamp('scheduled_payment_date');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('loan_id')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_repayments');
    }
};
