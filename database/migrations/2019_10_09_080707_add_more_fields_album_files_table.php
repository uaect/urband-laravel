<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsAlbumFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('album_files', function (Blueprint $table) {
            $table->string('title');
            $table->unsignedBigInteger('artist_id')->default('0');
            $table->index('artist_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('album_files', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('artist_id');
        });
    }
}
