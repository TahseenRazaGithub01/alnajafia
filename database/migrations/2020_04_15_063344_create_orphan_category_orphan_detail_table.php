<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphanCategoryOrphanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('orphan_category_orphan_detail', function (Blueprint $table) {
			
            $table->unsignedInteger('orphan_category_id');
			
            $table->unsignedInteger('orphan_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orphan_category_orphan_detail');
    }
}
