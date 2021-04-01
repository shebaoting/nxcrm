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
        // dd();
        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交设置吗', '部分设置提交之后需要重新刷新一下浏览器才能生效');
        $this->text('crmname', '网站名称')->default(admin_setting('crmname', 'NXCRM客户管理系统'));
        $this->url('crmurl', '网站地址')->default(admin_setting('crmurl', 'https://nx.tt'))->help('正确填写网址，并且必须以 / 结尾，否则会导致LOGO无法显示');
        $this->image('logo', '网站LOGO')->accept('jpg,png,gif,jpeg')->maxSize(512)->required()->autoUpload()->help('大小不要超过512K');
        $this->radio('horizontal_menu', '菜单位置')->options([0 => '侧栏', 1 => '顶栏'])->default(admin_setting('horizontal_menu', 0));
        $this->radio('style_type', '网站风格')->options([1 => '旧版', 2 => '大字版'])->default(admin_setting('style_type', 2));
        $this->radio('sidebar_style', '侧栏颜色')->options(['light' => '白色', 'dark' => '黑色', 'primary' => '彩色'])->default(admin_setting('sidebar_style', 'dark'));
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
            'horizontal_menu' => admin_setting('horizontal_menu', 'false'),
            'style_type' => admin_setting('style_type', 1),
        ];
    }
}
