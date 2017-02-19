<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saas_tenant_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status');
            $table->longText('comment_description')->nullable();
            $table->integer('tenant_id')->unsigned();
            $table->integer('added_by')->unsigned();
            $table->foreign('added_by')->references('id')->on('saas_users');
            $table->foreign('tenant_id')->references('id')->on('saas_tenants')->onDelete('cascade');
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
        Schema::dropIfExists('saas_tenant_comments');
    }
}
