<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('page_id');
            $table->unsignedInteger('section_id');
            
            $table->string('title');
            $table->longText('content')->nullable();
            $table->text('template_data')->nullable();

            $table->integer('sort_order')->nullable();
            $table->tinyInteger('published')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('page_id')->references('id')->on('pages');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_sections');
    }
}