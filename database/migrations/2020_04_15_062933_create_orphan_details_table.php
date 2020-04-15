<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('detail_name_en');
			
			$table->text('meta_title')->nullable();
			$table->text('meta_keyword')->nullable();
			$table->text('meta_description')->nullable();
			
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
        Schema::dropIfExists('orphan_details');
    }
}
