<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIslamicPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('islamic_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
			
			$table->string('detail_name_en');
            $table->string('slug')->nullable();
            $table->text('description_en')->nullable();
            $table->string('detail_page_image')->nullable();
            $table->string('detail_banner_image')->nullable();
			
			$table->boolean('khums')->default(0);
			$table->boolean('sistani')->default(0);
			$table->boolean('khamenei')->default(0);
			$table->boolean('najafy')->default(0);
			$table->boolean('khorasani')->default(0);
			$table->boolean('fayyadh')->default(0);
			$table->boolean('hakeem')->default(0);
			
			$table->boolean('niaz')->default(0);
			$table->boolean('general_niaz')->default(0);
			$table->boolean('muharram')->default(0);
			$table->boolean('ashura')->default(0);
			$table->boolean('shahadat_imam_hussain_as')->default(0);
			$table->boolean('arbaeen')->default(0);
			$table->boolean('shahadat_holy_prophet_pbuh')->default(0);
			$table->boolean('wiladat_holy_prophet_pbuh')->default(0);
			$table->boolean('shahadat_sayyida_fatima_sa')->default(0);
			$table->boolean('wiladat_sayyida_fatima_sa')->default(0);
			$table->boolean('wiladat_imam_ali_as')->default(0);
			$table->boolean('wiladat_imam_hussain_as')->default(0);
			$table->boolean('wiladat_abul_fadhl_as')->default(0);
			$table->boolean('wiladat_imam_mahdi_as')->default(0);
			$table->boolean('wiladat_imam_hassan_as')->default(0);
			$table->boolean('night_of_injury_imam_ali_as')->default(0);
			$table->boolean('shahadat_imam_ali_as')->default(0);
			$table->boolean('night_of_qadr')->default(0);
			$table->boolean('eid_al_ghadeer')->default(0);
			$table->boolean('eid_al_mubahilah')->default(0);
			$table->boolean('other')->default(0);
			
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
        Schema::dropIfExists('islamic_pages');
    }
}
