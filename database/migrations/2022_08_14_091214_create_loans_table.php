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
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->char('guid', 36)->unique()->index()->nullable();
            $table->double('total_amount_requested', 10,2)->nullable();
            $table->double('total_amount_received',10,2)->nullable();
            $table->tinyInteger('term')->nullable();
            $table->boolean('disclosure_flag')->default(0);
            $table->string('status', 50)->nullable();

            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->unsignedBigInteger('approved_by')->index()->nullable();
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
        Schema::dropIfExists('loans');
    }
};
