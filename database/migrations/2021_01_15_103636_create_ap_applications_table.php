<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_applications', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->string ('name', 50)->nullable (false)->comment ('编号名称');
            $table->unsignedInteger ('staff_id')->nullable (false)->comment ('申请人');
            $table->unsignedInteger ('proxy_staff_id')->nullable (true)->comment ('代理人');
            $table->unsignedInteger ('project_id')->nullable (false)->comment ('所属项目');
            $table->unsignedInteger ('auditable_id')->comment ('多态关联ID 数据ID');
            $table->string ('auditable_type', 50)->nullable (false)->comment ('多态类型名称 需经过审批的数据类型');
            $table->tinyInteger ('status')->nullable (false)->default (0)->comment ('提交状态 0 草稿 1 已提交待审核 2 审核完成 3 审核失败');
            $table->unsignedInteger ('order')->default (0);
            $table->timestamps ();
            $table->unique (['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('ap_applications');
    }
}
