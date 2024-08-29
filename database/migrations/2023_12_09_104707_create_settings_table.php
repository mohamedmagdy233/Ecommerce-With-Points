<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('footer_ar')->nullable();
            $table->text('footer_en')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('google')->nullable();
            $table->text('youtube')->nullable();
            $table->text('instagram')->nullable();
            $table->text('location_ar')->nullable();
            $table->text('location_en')->nullable();
            $table->text('location_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('terms')->nullable();
            $table->string('privacy')->nullable();
            $table->string('faqs')->nullable();
            $table->string('price_of_point')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
