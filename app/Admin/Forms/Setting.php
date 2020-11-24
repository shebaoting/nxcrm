<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Symfony\Component\HttpFoundation\Response;

class Setting extends Form
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
        foreach ($input as $slug => $value) {
           app()->settings->set($slug, $value);
        }

        // return $this->error('Your error message.');

        return $this->response()->success('设置成功')->location('settings');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $settings = app()->settings->all();
        // dd($settings);
        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交表单吗', 'content');
        foreach ($settings as $slug => $value) {
            if ($slug == 'crmname') {
                $this->text($slug, '网站名称')->default($value);
            } elseif ($slug == 'crmurl') {
                $this->url($slug, '网站地址')->default($value);
            } elseif ($slug == 'logo') {
                $this->image($slug, '网站LOGO')->accept('jpg,png,gif,jpeg')->maxSize(512)->required()->autoUpload()->help('大小不要超过512K');
            } elseif ($slug == 'color') {
                $this->radio($slug, '网站配色')->options(['douyin' => '抖音粉', 'blue' => '支付宝蓝', 'blue-light' => '飞书蓝', 'green' => '微信绿', 'default' => '政府蓝']);
            } elseif ($slug == 'body_class') {
                $this->switch($slug, '默认暗色')
                    ->customFormat(function ($v) {
                    return $v == '打开' ? 1 : 0;
                })
                    ->saving(function ($v) {
                        return $v ? 'dark-mode' : '';
                    })->help('更改后需清空浏览器缓存');
            }elseif ($slug == 'sidebar_style') {
                $this->radio($slug, '侧栏颜色')->options(['light' => '白色', 'primary' => '彩色']);
            }elseif ($slug == 'menu_layout') {
                $this->radio($slug, '侧栏布局')->options(['default' => '默认', 'sidebar-separate' => '分离']);
            } else {
                $this->text($slug)->default($value);
            }
        }
    }


    public function default()
    {
        if (app()->config->get('settings.body_class')){
            $body_class = 0;
        }else {
            $body_class = 1;
        }


        return [
            'logo' => app()->config->get('settings.logo'),
            'color' => app()->config->get('settings.color'),
            'body_class' => $body_class,
            'sidebar_style' => app()->config->get('settings.sidebar_style'),
            'menu_layout' => app()->config->get('settings.menu_layout'),
        ];
    }
}
