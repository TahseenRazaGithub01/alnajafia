<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSadaqahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadaqahs', function (Blueprint $table) {
            $table->bigIncrements('id');
			
			$table->string('detail_name_en');
            $table->string('slug')->nullable();
            $table->text('description_en')->nullable();
            $table->string('detail_page_image')->nullable();
            $table->string('detail_banner_image')->nullable();
			
			$table->boolean('recurring')->default(0);
			$table->boolean('monthly')->default(0);
            $table->boolean('quarterly')->default(0);
            $table->boolean('half_yearly')->default(0);
            $table->boolean('yearly')->default(0);
			$table->boolean('donation_amount')->default(0);
			$table->string('value_one')->nullable();
			$table->string('value_two')->nullable();
			$table->string('value_three')->nullable();

            $table->boolean('holy_personality')->default(0);
            $table->boolean('imam_zamin')->default(0);
            $table->boolean('imam_ali_mahdi_as')->default(0);
            $table->boolean('sayyida_zainab_sa')->default(0);
            $table->boolean('umm_ul_baneen')->default(0);
            $table->boolean('abul_fadhl_abbas_as')->default(0);
            $table->boolean('sayyid_ali_akbar_as')->default(0);
            $table->boolean('sayyida_ruqayyah_sakina_sa')->default(0);
            $table->boolean('sayyid_ali_asghar_as')->default(0);
			
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
        Schema::dropIfExists('sadaqahs');
    }
}
