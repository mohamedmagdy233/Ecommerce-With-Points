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
            $table->string('title')->nullable();
            $table->text('footer')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('youtube')->nullable();
            $table->text('instagram')->nullable();
            $table->text('location')->nullable();
            $table->text('location_url')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_hours')->nullable();
            $table->longText('terms')->nullable();
            $table->longText('privacy')->nullable();
            $table->longText('faqs')->nullable();
            $table->string('price_of_point')->nullable()->default(1);
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
