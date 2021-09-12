<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_teams', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->string ('name', 50)->default ('')->comment ('审核小组名称');
            $table->unsignedInteger ('project_id')->default (0)->comment ('项目');
            $table->foreign ('project_id')->references ('id')->on ('ap_projects')->onDelete ('cascade');
            $table->string ('departments', 255)->nullable ()->comment ('部门适用范围');
            $table->string ('staff', 255)->nullable ()->comment ('人员适用范围');
            $table->unsignedInteger ('order')->default (0);


            $table->timestamps ();

            $table->unique (['name', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('ap_teams');
    }
}
