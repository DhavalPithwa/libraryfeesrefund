<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_requests', function (Blueprint $table) {
            $table->bigIncrements('Req_id');
            $table->bigInteger('enroll');
            $table->foreign('enroll')->references('enroll')->on('students');
            $table->bigInteger('faculty_id')->nullable()->unsigned();
            $table->foreign('faculty_id')->references('id')->on('users');
            $table->string('lorpdf_path')->nullable();
            $table->string('bonafiepdf_path')->nullable();
            $table->integer('status');
            $table->integer('type');
            $table->string('completedby')->nullable();
            $table->date('paydate')->nullable();
            $table->string('tran_id')->nullable();
            $table->integer('amount')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('doc_requests');
    }
}
