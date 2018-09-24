<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50);
            $table->string('from_name', 255)->nullable();
            $table->string('from_email', 255);
            $table->string('to_name', 255)->nullable();
            $table->string('to_email', 255);
            $table->string('subject', 255);
            $table->text('message');
            $table->string('status', 255);
            $table->string('mail_id', 255);
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
        Schema::dropIfExists('email_logs');
    }
}
