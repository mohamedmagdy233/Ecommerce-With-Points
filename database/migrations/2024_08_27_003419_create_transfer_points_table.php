<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id')->constrained('customers');
            $table->foreignId('to_id')->constrained('customers');
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->integer('points');
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
        Schema::dropIfExists('transfer_points');
    }
};
