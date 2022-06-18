<?php

namespace App\Admin\Metrics\Examples;

use App\Http\Controllers\Controller;
use Dcat\Admin\Form;
use App\Models\CrmProgram as program_info;
use Dcat\Admin\Admin;

class CrmProgram extends Controller
{
    public static function build()
    {
        Form::dialog('业绩目标')
            ->click('.create-form') // 绑定点击按钮
            ->url('programs/create') // 表单页面链接，此参数会被按钮中的 “data-url” 属性替换。。
            ->width('700px') // 指定弹窗宽度，可填写百分比，默认 720px
            ->height('550px') // 指定弹窗高度，可填写百分比，默认 690px
            ->success(
                <<<JS
         // 保存成功之后刷新页面
         Dcat.reload();
         JS
            ); // 新增成功后刷新页面


            Form::dialog('业绩目标')
            ->click('.edit-form')
            ->width('700px') // 指定弹窗宽度，可填写百分比，默认 720px
            ->height('550px') // 指定弹窗高度，可填写百分比，默认 690px
            ->success('Dcat.reload()'); // 编辑成功后刷新页面

            $program_info = program_info::where('admin_user_id', Admin::user()->id)->first();
            if ($program_info) {
                $editPage = admin_base_path('programs/'.$program_info->id.'/edit');
            }else {
                $editPage = '';
            }
        return view('admin.metrics.examples.program_button',['program_info' => $program_info,'editPage' => $editPage]);
    }
}
