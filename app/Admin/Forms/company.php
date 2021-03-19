<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Admin;
use Symfony\Component\HttpFoundation\Response;

class company extends Form
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
        $this->text('company_name', '公司全称')->default(admin_setting('company_name', 'NXCRM'));
        $this->text('company_abbreviation', '公司简称')->default(admin_setting('company_abbreviation', 'NXCRM'));
        $this->text('company_phone', '联系电话')->default(admin_setting('company_phone', '18888888888'));
        $this->text('company_email', '公司邮箱')->default(admin_setting('company_email', 'mail@qq.com'));
        $this->text('company_address', '公司地址')->default(admin_setting('company_address', '北京XX区XX路'));
        $this->keyValue('company_info', '其他信息')->saving(function ($v) {
            return json_encode($v);
        });
    }


    public function
    default()
    {

        return [
            'company_name' => admin_setting('company_name', '南相科技'),
            'company_abbreviation' => admin_setting('company_abbreviation', '南相'),
            'company_phone' => admin_setting('company_phone', '18888888888'),
            'company_email' => admin_setting('company_email', 'mail@qq.com'),
            'company_address' => admin_setting('company_address', '地址'),
            'company_info' => admin_setting('company_info'),
        ];
    }
}
