<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up ()
    {
        Schema::create ('ap_employees', function (Blueprint $table)
        {
            $table->increments ('id');
            $table->unsignedInteger ('pid')->nullable (false)->default (0)->comment ('上级');
            $table->unsignedInteger ('user_id')->nullable (false)->default (0)->comment ('关联前台账号');
            $table->unsignedInteger ('admin_user_id')->nullable (false)->default (0)->comment ('关联后台账号');
            $table->string ('code', 50)->nullable ()->comment ('员工号');
            $table->string ('name', 50)->comment ('姓名');
            $table->tinyInteger ('gender')->default(0)->comment ('性别');
            $table->string ('mobile', 20)->nullable ()->comment ('移动电话');
            $table->string ('email', 50)->nullable ()->comment ('电子邮件');
            $table->string ('social1', 50)->nullable ()->comment ('社交账号1');
            $table->string ('social2', 50)->nullable ()->comment ('社交账号2');
            $table->string ('social3', 50)->nullable ()->comment ('社交账号3');
            $table->string ('social4', 50)->nullable ()->comment ('社交账号4');
            $table->string ('social5', 50)->nullable ()->comment ('社交账号5');
            $table->string ('hired', 20)->nullable ()->comment ('雇用日期');
            $table->string ('birthday', 20)->nullable ()->comment ('生日');
            $table->string ('workday', 20)->nullable ()->comment ('开始工作日');
            $table->unsignedInteger ('department_id')->nullable ()->default (0)->comment ('用户所在部门，默认部门id 0');
            $table->string ('departments', 255)->nullable ()->comment ('部门层级');
            $table->string ('title', 20)->nullable ()->comment ('岗位名称');
            $table->string ('rank', 20)->nullable ()->comment ('级别名称');
            $table->tinyInteger ('status')->default (1);
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
        Schema::dropIfExists ('ap_employees');
    }
}
