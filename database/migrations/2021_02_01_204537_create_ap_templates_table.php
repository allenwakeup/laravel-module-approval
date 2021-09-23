<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_templates', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->unsignedInteger ('pid')->default (0)->comment ('父级ID');
            $table->string ('code', 20)->nullable (false)->comment ('编码');
            $table->string ('name', 50)->nullable (false)->comment ('名称');
            $table->string ('alias', 50)->nullable ()->comment ('别名');
            $table->string ('description', 255)->nullable ()->comment ('描述');
            $table->string ('path', 255)->nullable ()->comment ('BPMN文件地址');
            $table->unsignedInteger ('category_id')->nullable ()->comment ('分类ID');
            $table->unsignedInteger('type')->default(0)->comment('类型');
            $table->string ('group', 20)->nullable ()->comment ('分组');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1);
            $table->timestamps ();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('ap_templates');
    }
}
