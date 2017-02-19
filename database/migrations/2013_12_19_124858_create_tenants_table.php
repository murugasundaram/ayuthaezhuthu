<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saas_tenants', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('organisation_name', 255);
                $table->string('organisation_unique_name', 20);
                $table->string('email', 100);
                $table->integer('status');
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saas_tenants');
    }
}
