<?php

namespace App\Admin\Forms;

use Dcat\Admin\Widgets\Form;
use Symfony\Component\HttpFoundation\Response;

class Highseas extends Form
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
        $this->confirm('您确定要提交设置吗', 'content');
        $this->number('leadshighseas', '线索过期(天)')->attribute('min', 1)->default(admin_setting('leadshighseas', 30))->help('超过此天数未跟进的线索，将被自动放入公海');
        $this->number('customershighseas', '客户过期(天)')->attribute('min', 1)->default(admin_setting('customershighseas', 180))->help('超过此天数未跟进的客户，将被自动放入公海，由于客户已经达成过交易，建议此处设置尽量大于半年');
    }


    public function
    default()
    {
        return [
            'leadshighseas' => admin_setting('leadshighseas', 30),
            'customershighseas' => admin_setting('customershighseas', 180),
        ];
    }
}
