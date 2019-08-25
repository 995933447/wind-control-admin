<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('app_id')->comment('app id');
            $table->string('link')->comment('链接')->default('');
            $table->tinyInteger('type')->comment('0.域名，1.ip')->default(0);
            $table->tinyInteger('status')->comment('状态,0.被墙，1正常')->default(1);
            $table->tinyInteger('qq_status')->comment('qq状态,0.qq被墙，1.qq正常')->default(1);
            $table->tinyInteger('wechat_status')->comment('微信状态,0.微信被墙，1.微信正常')->default(1);
            $table->tinyInteger('is_enable_qq_check')->comment('是否开启QQ检测,1开启，0不开启')->default(0);
            $table->tinyInteger('is_enable_wechat_check')->comment('是否开启微信检测,1开启，0不开启')->default(0);
            $table->tinyInteger('check_interval')->comment('互联网检测时间间隔,分钟数');
            $table->tinyInteger('qq_check_interval')->comment('qq检测时间间隔,分钟数');
            $table->tinyInteger('wechat_check_interval')->comment('微信检测时间间隔,分钟数');
            $table->tinyInteger('from')->comment('站点:0.api,1.静态资源,2.注册页面,3.门户');
            $table->integer('stop_time')->comment('被墙时间')->default(0);
            $table->integer('qq_stop_time')->comment('qq被墙时间')->default(0);
            $table->integer('wechat_stop_time')->comment('微信被墙时间')->default(0);
            $table->integer('hack_time')->comment('劫持时间')->default(0);
            $table->integer('last_check_time')->comment('最后一次检测时间')->default(0);
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
        Schema::dropIfExists('domains');
    }
}
