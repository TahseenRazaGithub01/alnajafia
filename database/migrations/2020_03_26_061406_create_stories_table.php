<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name_en');
			$table->string('name_fr')->nullable();
			$table->string('name_ar')->nullable();
			$table->string('slug', 255);
			$table->string('story_image')->nullable();
			$table->text('description_en')->nullable();
			$table->text('description_fr')->nullable();
			$table->text('description_ar')->nullable();
			$table->boolean('our_story')->default(1);
			$table->boolean('success_story')->default(0);
            $table->boolean('news')->default(0);
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
        Schema::dropIfExists('stories');
    }
}
