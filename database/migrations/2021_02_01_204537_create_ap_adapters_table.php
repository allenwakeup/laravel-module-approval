<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApAdaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_adapters', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->unsignedInteger ('pid')->default (0)->comment ('父级ID');
            $table->string ('code', 20)->nullable (false)->comment ('编码');
            $table->string ('name', 50)->nullable (false)->comment ('名称');
            $table->string ('alias', 50)->nullable ()->comment ('别名');
            $table->string ('description', 255)->nullable ()->comment ('描述');
            $table->text ('payload')->nullable (true)->comment ('适配器配置');
            $table->unsignedInteger ('category_id')->nullable ()->comment ('分类ID');
            $table->string ('group', 20)->nullable ()->comment ('分组');
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
        Schema::dropIfExists ('ap_adapters');
    }
}
