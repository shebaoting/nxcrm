<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Admin;
use Symfony\Component\HttpFoundation\Response;

class setting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return Response
     */
    public function handle(array $input)
    {
        // dump($input);
        admin_setting($input);

        // return $this->error('Your error message.');

        return $this->response()->success('设置成功')->refresh();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        Admin::style(
            <<<CSS
    .douyin {
        border-color: #fe2d54;
    }
    .blue {
        border-color: #6d8be6;
    }
    .blue-light {
        border-color: #62a8ea;
    }
    .wechat {
        border-color: #07c160;
    }
    .green {
        border-color: #4e9876;
    }
    .default {
        border-color: #586cb1;
    }
    .themecolor {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    margin-left: -28px;
    display: block;
    border-width:8px;
    border-style:solid;
    }
CSS
        );
        // dd();
        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交设置吗', '部分设置提交之后需要重新刷新一下浏览器才能生效');
        $this->text('crmname', '网站名称')->default(admin_setting('crmname', 'NXCRM客户管理系统'));
        $this->url('crmurl', '网站地址')->default(admin_setting('crmurl', 'https://nx.tt'));
        $this->image('logo', '网站LOGO')->accept('jpg,png,gif,jpeg')->maxSize(512)->required()->autoUpload()->help('大小不要超过512K');
        $this->radio('color', '网站配色')
            ->options([
            'douyin' => '<span class="douyin themecolor"></span>',
            'blue' => '<span class="blue themecolor"></span>',
            'blue-light' => '<span class="blue-light themecolor"></span>',
            'wechat' => '<span class="wechat themecolor"></span>',
            'green' => '<span class="green themecolor"></span>',
            'default' => '<span class="default themecolor"></span>'
            ])
            ->attribute(['class' => 'hahahaah']);
        $this->radio('sidebar_style', '侧栏颜色')->options(['light' => '白色', 'primary' => '彩色']);
        $this->radio('body_class', '侧栏布局')->options(['default' => '默认', 'sidebar-separate' => '分离']);
        $this->radio('logintheme', '登录页样式')->options(['bigpicture' => '大图', 'simple' => '简单']);
        $this->image('logobg', '登陆页背景图')->accept('jpg,png,gif,jpeg')->maxSize(1024)->autoUpload()->help('大小不要超过512K，仅在登录页为大图模式下生效');
        // $this->switch('debug', '开发者模式')
        // ->customFormat(function ($v) {
        //     return $v == '打开' ? 1 : 0;
        // })
        // ->saving(function ($v) {
        //     return $v ? 'true' : 'false';
        // })
        // ->help('如非排查错误，请平时关闭此选项');
    }


    public function
    default()
    {

        return [
            'logo' => admin_setting('logo', public_path().'/static/img/logo.png'),
            'color' => admin_setting('color', 'green'),
            'body_class' => admin_setting('body_class', 'sidebar-separate'),
            'sidebar_style' => admin_setting('sidebar_style', 'light'),
            'body_class' => admin_setting('body_class', 'sidebar-separate'),
            'logintheme' => admin_setting('logintheme', 'bigpicture'),
            'logobg' => admin_setting('logobg'),
        ];
    }
}
