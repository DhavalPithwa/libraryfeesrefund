<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_requests', function (Blueprint $table) {
            $table->bigIncrements('Req_id');
            $table->bigInteger('enroll');
            $table->foreign('enroll')->references('enroll')->on('students');
            $table->string('lfees_no')->nullable();
            $table->string('lfees_path')->nullable();
            $table->string('sem6fee_path')->nullable();
            $table->string('passbook_path');
            $table->string('cheque_path');
            $table->string('gtugrade_path');
            $table->integer('status');
            $table->string('completedby')->nullable();
            $table->string('paydate')->nullable();
            $table->string('reason')->nullable();
            $table->string('tran_id')->nullable();
            $table->integer('amount');
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
        Schema::dropIfExists('fee_requests');
    }
}
