<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ap_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('pid')->default(0)->comment('父级ID');
            $table->string('code', 50)->default('')->comment('编码');
            $table->string('name', 50)->default('')->comment('名称');
            $table->string('short', 20)->default('')->comment('简称');
            $table->string('alias', 50)->default('')->comment('别名');
            $table->string('description', 255)->nullable ()->comment ('描述');
            $table->string('path', 255)->default('')->comment('路径');
            $table->string('path_text', 255)->default('')->comment('路径名称');
            $table->unsignedInteger('level')->default(0)->comment('分级');
            $table->unsignedInteger('type')->default(0)->comment('类型');
            $table->unsignedInteger('order')->default(0)->comment('排序');
            $table->unsignedInteger('status')->default(1)->comment('状态 0 禁用 1 启用');
            $table->timestamps();

            $table->unique(['code']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ap_categories');
    }
}
