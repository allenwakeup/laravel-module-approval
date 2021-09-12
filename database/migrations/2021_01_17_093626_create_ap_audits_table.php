<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_audits', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->unsignedInteger ('auditable_id')->comment ('多态关联ID');
            $table->string ('auditable_type', 50)->nullable (false)->comment ('多态类型名称');
            $table->unsignedInteger ('crew_id')->default (0)->comment ('审批节点ID');
            $table->text ('crew')->nullable (true)->comment ('审批节点快照');
            $table->unsignedInteger ('staff_id')->nullable (false)->comment ('申请人');
            $table->text ('staff')->nullable (true)->comment ('操作人信息快照');
            $table->tinyInteger ('result')->nullable ()->default (0)->comment ('审批结果 0 未审核  1 已通过  2 驳回');
            $table->string ('note', 255)->nullable ()->comment ('审批备注');
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
        Schema::dropIfExists ('ap_audits');
    }
}
