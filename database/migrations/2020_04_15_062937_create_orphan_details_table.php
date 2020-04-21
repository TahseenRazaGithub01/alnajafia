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
            $table->string('slug')->nullable();
            $table->text('description_en')->nullable();
            $table->string('detail_page_image')->nullable();
            $table->string('detail_banner_image')->nullable();

            $table->boolean('min_amount')->default(1);
            $table->string('min_value')->nullable();
            $table->boolean('recurring')->default(0);
			$table->boolean('monthly')->default(0);
            $table->boolean('quarterly')->default(0);
            $table->boolean('half_yearly')->default(0);
            $table->boolean('yearly')->default(0);
            $table->boolean('year_around')->default(0);
            $table->boolean('syed')->default(0);
            $table->boolean('amount')->default(1);
            $table->string('amount_value')->nullable();
            $table->boolean('duration')->default(0);
            $table->date('start_duration_date')->nullable();
            $table->date('end_duration_date')->nullable();
            $table->boolean('count_number')->default(0);
            $table->string('min_count')->nullable();
            $table->string('max_count')->nullable();
            
			$table->text('meta_title')->nullable();
			$table->text('meta_keyword')->nullable();
			$table->text('meta_description')->nullable();
            $table->boolean('page_status')->default(1);
			
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
