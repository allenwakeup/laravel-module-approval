<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_crews', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->string ('name', 50)->default ('')->comment ('审批节点名称，例如初审、终审');
            $table->unsignedInteger ('team_id')->default (0)->comment ('审批组');
            $table->foreign ('team_id')->references ('id')->on ('ap_teams')->onDelete ('cascade');
            $table->string ('title', 50)->comment ('审批标签，按职称');
            $table->string ('rank', 50)->comment ('审批标签，按级别');
            $table->unsignedInteger ('employee_primary')->default (0)->comment ('审批人1');
            $table->unsignedInteger ('employee_secondary')->default (0)->comment ('审批人2');
            $table->unsignedInteger ('employee_other')->default (0)->comment ('审批人3');
            $table->string ('condition', 20)->nullable (false)->default ('PEOPLE_ONE')->comment ('审批人审核条件，如 设置的是人还是标签，还是都有？ 只有人：上级审批 PARENT 只要一个人审批 PEOPLE_ONE，所有人都批，PEOPLE_ALL；只有标签：TAG；混合：COMBINE_OR');
            $table->unsignedInteger ('order')->default (0)->comment ('排序，根据节点名称合理排序');
            $table->timestamps ();

            $table->unique (['name', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists ('ap_crews');
    }
}
