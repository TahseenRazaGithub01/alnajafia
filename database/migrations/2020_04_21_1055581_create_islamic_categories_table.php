<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIslamicCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('islamic_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
			
			$table->string('category_name_en');
			$table->string('slug');
			$table->text('category_description_en')->nullable();
			$table->string('category_banner_image')->nullable();
			
			$table->text('meta_title')->nullable();
			$table->text('meta_keyword')->nullable();
			$table->text('meta_description')->nullable();
			$table->boolean('category_status')->default(1);
			
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
        Schema::dropIfExists('islamic_categories');
    }
}
