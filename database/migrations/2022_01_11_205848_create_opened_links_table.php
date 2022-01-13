<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenedLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opened_links', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger("user_id")->nullable();
            // $table->foreign("user_id")
            // ->references("id")
            // ->on("users")
            // ->onDelete('set null');;

            $table->unsignedBigInteger("url_id")->nullable();
            $table->foreign("url_id")
            ->references("id")
            ->on("U_R_L_S")
            ->onDelete('set null');;
            $table->string('country', 20)->nullable();

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opened_links');
    }
}
