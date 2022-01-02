<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Admin;
use Symfony\Component\HttpFoundation\Response;

class Reminder extends Form
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
        // Since v1.6.5 弹出确认弹窗
        $this->confirm('您确定要提交设置吗', '部分设置提交之后需要重新刷新一下浏览器才能生效');
        $this->radio('reminder.contract_day', '提前通知时间')->options(['weekly' => '一周', 'monthly'=> '一月'])->default('weekly');
        $this->fieldset('通知客户', function (Form $form) {
            $form->text('reminder.contract_user_smscode', '短信模板CODE');
            $form->checkbox('reminder.contract_user_method', '通知方式')
                ->options(['phone' => '手机短信'])
                ->saving(function ($value) {
                    return json_encode($value);
                });
        });
        $this->fieldset('通知销售人员', function (Form $form) {
            $form->text('reminder.contract_admin_smscode', '短信模板CODE');
            $form->checkbox('reminder.contract_admin_method', '通知方式')
                ->options(['phone' => '手机短信', 'web' => '站内提醒'])
                ->saving(function ($value) {
                    return json_encode($value);
                });
        });
    }
    public function default()
    {
        return [
            'reminder' => admin_setting_array('reminder'),
            // 'reminder.contract_day' => admin_setting_array('reminder')['contract_day'],
        ];
    }
}
