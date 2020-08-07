<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_management', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('page');
                $table->string('title')->nullable();
                $table->string('email')->nullable();
                $table->string('phone')->nullable();
                $table->string('location')->nullable();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->tinyInteger('status')->default('1');
                $table->timestamps();
                $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_management');
    }
}
