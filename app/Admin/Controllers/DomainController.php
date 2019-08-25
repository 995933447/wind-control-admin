<?php

namespace App\Admin\Controllers;

use App\Domain;
use App\App;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class DomainController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '域名检测';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Domain);

        $grid->filter(function ($filter) {
            $filter->column(1/2, function ($filter) {
                $filter->disableIdFilter();
                $filter->group('Id', __('Id'), function ($group) {
                    $group->equal('等于');
                    $group->gt('大于');
                    $group->lt('小于');
                    $group->nlt('不小于');
                    $group->ngt('不大于');
                });
                $filter->in('from', __('Belong to site'))->Select([0 => 'api服务器', 1 => '静态资源服务器', 2 => '注册登录服务器', 3 => '前端门户服务器']);
                $filter->startsWith('name', __('Domain'));
                $filter->equal('ip', __('Ip'));
                $filter->between('stop_time', __('Stop time'))->datetime();
            });

            $filter->column(1/2, function ($filter) {
                $filter->in('status', __('Status'))->Select([0 => '停用', 1 => '有效']);
                $filter->between('created_at', __('Created at'))->datetime();
                $filter->between('updated_at', __('Updated at'))->datetime();
                $filter->between('last_check_time', __('Last check time'))->datetime();
            });
        });


        $grid->column('id', __('Id'));
        $grid->column('link', __('Link'))->link();
        $grid->column('type', __('Type'))->display(function ($type) {
            switch ($type) {
                case 0:
                    return '域名';
                case 1:
                    return 'IP';
            }
        });
        $grid->column('status', __('Status'))->switch(
            [
                'on' => ['value' => 1, 'text' => '有效'],
                'off' => ['value' => 0, 'text' => '停用']
            ]
        );
        $grid->column('qq_status', __('QQ status'))->switch(
            [
                'on' => ['value' => 1, 'text' => '有效'],
                'off' => ['value' => 0, 'text' => '停用']
            ]
        );
        $grid->column('wechat_status', __('Wechat status'))->switch(
            [
                'on' => ['value' => 1, 'text' => '有效'],
                'off' => ['value' => 0, 'text' => '停用']
            ]
        );
        $grid->column('is_enable_qq_check', __('Is enable qq check'))->switch(
            [
                'on' => ['value' => 1, 'text' => '开启'],
                'off' => ['value' => 0, 'text' => '关闭']
            ]
        );
        $grid->column('is_enable_wechat_check', __('Is enbale wechat check'))->switch(
            [
                'on' => ['value' => 1, 'text' => '开启'],
                'off' => ['value' => 0, 'text' => '关闭']
            ]
        );
        $grid->column('check_interval', __('Check interval'));
        $grid->column('qq_check_interval', __('Qq check interval'));
        $grid->column('wechat_check_interval', __('Wechat Check interval'));
        $grid->column('app.name', __('App name'));
        $grid->column('from', __('Belong to site'))->display(function ($from) {
            switch ($from) {
                case 0:
                    return "api服务器";
                case 1:
                    return "静态资源服务器";
                case 2:
                    return "注册登录服务器";
                case 3:
                    return "前端门户服务器";
                case 4:
                    return "QQ投放门户";
            }
        });
        $grid->column('stop_time', __('Stop time'))->display(function ($stopTime) {
            if ($stopTime)
                return date('Y-m-d H:i:s', $stopTime);
        });
        $grid->column('qq_stop_time', __('QQ stop time'))->display(function ($qqStopTime) {
            if ($qqStopTime)
                return date('Y-m-d H:i:s', $qqStopTime);
        });
        $grid->column('wechat_stop_time', __('Wechat stop time'))->display(function ($wechatStopTime) {
            if ($wechatStopTime)
                return date('Y-m-d H:i:s', $wechatStopTime);
        });
        $grid->column('last_check_time', __('Last check time'))->display(function ($lastCheckTime) {
            if ($lastCheckTime)
                return date('Y-m-d H:i:s', $lastCheckTime);
        });


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Domain::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('link', __('Link'))->link();
        $show->field('type', __('Type'))->as(function ($type) {
            switch ($type) {
                case 0:
                    return '域名';
                case 1:
                    return 'IP';
            }
        });
        $show->field('status', __('Status'))->as(function ($status) {
            switch ($status) {
                case 0:
                    return '无效';
                case 1:
                    return '有效';
            }
        });
        $show->field('qq_status', __('QQ status'))->as(function ($qqStatus) {
            switch ($qqStatus) {
                case 0:
                    return '无效';
                case 1:
                    return '有效';
            }
        });
        $show->field('wechat_status', __('Wechat status'))->as(function ($wechatStatus) {
            switch ($wechatStatus) {
                case 0:
                    return '无效';
                case 1:
                    return '有效';
            }
        });
        $show->field('is_enable_qq_check', __('Is enable qq check'))->as(function ($isEnableQqCheck) {
            switch ($isEnableQqCheck) {
                case 0:
                    return '关闭';
                case 1:
                    return '启用';
            }
        });
        $show->field('is_enable_wechat_check', __('Is enbale wechat check'))->as(function ($isEnableWechatCheck) {
            switch ($isEnableWechatCheck) {
                case 0:
                    return '关闭';
                case 1:
                    return '启用';
            }
        });
        $show->field('check_interval', __('Check interval'));
        $show->field('qq_check_interval', __('Qq check interval'));
        $show->field('wechat_check_interval', __('Wechat Check interval'));
        $show->field('app_id', __('App name'))->as(function ($appId) {
            return App::find($appId)->name;
        });
        $show->field('from', __('Belong to site'))->as(function ($from) {
            switch ($from) {
                case 0:
                    return "api服务器";
                case 1:
                    return "静态资源服务器";
                case 2:
                    return "注册服务器";
                case 3:
                    return "前端门户服务器";
                case 4:
                    return "QQ投放门户";
            }
        });
        $show->field('stop_time', __('Stop time'))->as(function ($stopTime) {
            if ($stopTime)
                return date('Y-m-d H:i:s', $stopTime);
        });
        $show->field('qq_stop_time', __('QQ stop time'))->as(function ($qqStopTime) {
            if ($qqStopTime)
                return date('Y-m-d H:i:s', $qqStopTime);
        });
        $show->field('wechat_stop_time', __('Wechat stop time'))->as(function ($wechatStopTime) {
            if ($wechatStopTime)
                return date('Y-m-d H:i:s', $wechatStopTime);
        });
        $show->field('last_check_time', __('Last check time'))->as(function ($lastCheckTime) {
            if ($lastCheckTime)
                return date('Y-m-d H:i:s', $lastCheckTime);
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Domain);

        $apps = App::select('id', 'name')->get();
        $options = [];
        foreach ($apps as $app) {
            $options[$app->id] = $app->name;
        }
        $form->select('app_id', __('App name'))->options($options)->creationRules('required');
        $form->url('link', __('Link'))->creationRules('required|unique:domains');
        $form->select('type', __('Type'))->options(
            [
                0 => '域名',
//                1 => 'IP'
            ]
        )->rules('required');
        $form->switch('status', __('Status'))->default(1);
        $form->switch('qq_status', __('QQ status'))->default(1);
        $form->switch('wechat_status', __('Wechat status'))->default(1);
        $form->switch('is_enable_qq_check', __('Is enable qq check'))->default(0);
        $form->switch('is_enable_wechat_check', __('Is enbale wechat check'))->default(0);
        $form->number('check_interval', __('Check interval'))->default(20);
        $form->number('qq_check_interval', __('Qq check interval'))->default(20);
        $form->number('wechat_check_interval', __('Wechat Check interval'))->default(20);
        $form->select('from', __('Belong to site'))->options([
           0 => 'api服务器',
           1 => '静态资源服务器',
           2 => '注册服务器',
           3 => '前端门户服务器',
           4 => 'QQ投放门户'
        ])->rules('required');

        return $form;
    }
}
