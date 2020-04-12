<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('project_name_en');
			$table->string('slug');
			$table->text('project_description_en')->nullable();
			$table->string('project_image')->nullable();
			$table->string('project_banner_image')->nullable();
			$table->boolean('project_status')->default(1);
			$table->boolean('subcategory_options')->default(1);
			$table->boolean('wheel_chair')->default(0);
			$table->boolean('general_fund')->default(0);
			$table->boolean('education_phd')->default(0);
			$table->boolean('education_master')->default(0);
			$table->boolean('cart')->default(0);
			$table->boolean('eye_cataract')->default(0);
			$table->boolean('aun')->default(0);

            $table->boolean('donation_process')->default(0);
            $table->string('min_amount')->nullable();
            $table->boolean('recurring')->default(0);
            $table->boolean('monthly')->default(0);
            $table->boolean('quarterly')->default(0);
            $table->boolean('half_yearly')->default(0);
            $table->boolean('yearly')->default(0);
            $table->boolean('year_around')->default(0);
            $table->boolean('fixed_amount')->default(0);
            $table->string('fixed_amount_value')->nullable();
            $table->boolean('duration')->default(0);
            $table->date('start_duration_date')->nullable();
            $table->date('end_duration_date')->nullable();
            $table->boolean('count_number')->default(0);
            $table->string('min_count')->nullable();
            $table->string('max_count')->nullable();
            
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
        Schema::dropIfExists('project_details');
    }
}
