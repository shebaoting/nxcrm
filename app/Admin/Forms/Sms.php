<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Admin;
use Symfony\Component\HttpFoundation\Response;

class Sms extends Form
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
        // dd(admin_setting_array('sms')['aliyun']);
        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交设置吗', '部分设置提交之后需要重新刷新一下浏览器才能生效');
        $this->embeds('sms.aliyun','阿里云短信', function ($form) {
            $form->text('access_key_id','AccessKey ID')->required();
            $form->password('access_key_secret','AccessKey Secret')->required();
            $form->text('sign_name','短信签名')->required();
        })->saving(function ($v) {
            // 转化为json格式存储
            return json_encode($v);
        });
    }


    public function default()
    {
        return [
            'sms.aliyun' => admin_setting_array('sms')['aliyun'],
        ];
    }
}
