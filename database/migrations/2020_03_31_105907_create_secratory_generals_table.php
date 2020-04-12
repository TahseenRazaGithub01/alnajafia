<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecratoryGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secratory_generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_image')->nullable();
            $table->string('title_en');
            $table->string('title_fr')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('message_image')->nullable();
            $table->text('message_description_en')->nullable();
            $table->text('message_description_fr')->nullable();
            $table->text('message_description_ar')->nullable();
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
        Schema::dropIfExists('secratory_generals');
    }
}
