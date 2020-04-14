<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrphanStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_students', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name_en');
			$table->enum('gender', ['male', 'female']);
			$table->enum('orphan_type', ['basic', 'zehra']);
			$table->enum('cast', ['syed', 'non-syed']);
			$table->date('date_of_birth')->nullable();
			$table->string('orphan_profile_id');
			$table->string('city')->nullable();
			$table->string('mother_name')->nullable();
			$table->string('orphan_profile_picture')->nullable();
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
        Schema::dropIfExists('orphan_students');
    }
}
