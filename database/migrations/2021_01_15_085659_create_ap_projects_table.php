<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_projects', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->unsignedInteger ('pid')->default (0)->comment ('父级项目ID');
            $table->string ('name', 50)->default ('');
            $table->unsignedInteger ('department_id')->default (0)->comment ('部门ID');
            $table->unsignedInteger ('adapter_id')->comment ('适配器');
            $table->unsignedInteger ('order')->default (0);
            $table->timestamps ();

            $table->unique (['name', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('ap_projects');
    }
}
