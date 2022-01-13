<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateURLSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_r_l_s', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();;
            $table->string("Real_Path",2048);
            // $table->password('password');
            $table->string("New_Path")->unique();
            $table->string('password')->nullable();;
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")
            ->references("id")
            ->on("users")
            ->onDelete("restrict")
            ->onUpdate("restrict");
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
        Schema::dropIfExists('u_r_l_s');
    }
}
