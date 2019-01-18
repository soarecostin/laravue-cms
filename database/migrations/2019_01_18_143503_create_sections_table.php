<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');

            $table->string('section_type_name');

            $table->string('title');
            $table->string('desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('template_name');
            $table->text('fields')->nullable();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('section_type_name')->references('name')->on('section_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}