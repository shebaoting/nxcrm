<?php

namespace App\Admin\Controllers;

use App\Models\Customfield;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CustomfieldController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Customfield(), function (Grid $grid) {
            $grid->column('model')->using(['customer' => '客户模块', 'contact' => '联系人', 'contract' => '合同'])->label([
                'customer' => 'success',
                'contact' => 'red',
                'contract' => 'yellow',
            ]);
            $grid->column('name');
            $grid->column('field');
            $grid->column('type')->using([
                'text' => '单行文本',
                'textarea' => '多行文本',
                'select' => '下拉单选',
                'number' => '数字',
                'switch' => '开关',
                'radio' => '单选',
                'checkbox' => '多选',
                'multipleSelect' => '下拉多选',
                'email' => '邮箱',
                'url' => '网址',
                'mobile' => '手机',
                'time' => '时间',
                'date' => '日期',
                'datetime' => '时间日期',
                'dateRange' => '日期范围',
                'datetimeRange' => '时间日期范围',
                'range' => '范围',
                'ip' => 'ip地址',
                'color' => '颜色',
                ]);
            $grid->column('show')->switch();
            $grid->column('required')->switch();
            // $grid->column('iflist')->switch();
            $grid->column('unique')->switch();
            $grid->disableViewButton();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Customfield(), function (Show $show) {
            $show->field('id');
            $show->field('model');
            $show->field('name');
            $show->field('field');
            $show->field('type');
            $show->field('required');
            $show->field('iflist');
            $show->field('default');
            $show->field('help');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Customfield(), function (Form $form) {
            $form->display('id');
            $form->radio('model')->options(['customer' => '客户'])->required();
            // $form->radio('model')->options(['customer' => '客户', 'contact'=> '联系人', 'contract'=> '合同'])->required();
            $form->text('name')->placeholder('当前字段的中文名称')->required();
            $form->text('field')->placeholder('当前字段的英文名称或者拼音')->required()->rules('regex:/^[a-zA-Z][a-zA-Z0-9_]*$/|min:3', [
                'regex' => '标识只能以字母开头并且只能包含字母，数组或者_',
                'min'   => '标识长度不能少于10个字符',
            ]);
            $form->icon('icon');
            $form->radio('type')->options([
                'text' => '单行文本',
                'textarea' => '多行文本',
                'select' => '下拉单选',
                'number' => '数字',
                'switch' => '开关',
                'radio' => '单选',
                'checkbox' => '多选',
                'multipleSelect' => '下拉多选',
                'email' => '邮箱',
                'url' => '网址',
                'mobile' => '手机',
                'time' => '时间',
                'date' => '日期',
                // 'datetime' => '时间日期',
                // 'dateRange' => '日期范围',
                // 'datetimeRange' => '时间日期范围',
                // 'range' => '范围',
                'ip' => 'ip地址',
                'color' => '颜色',
                ])->required()
                ->when(['select', 'radio', 'checkbox', 'multipleSelect'], function (Form $form) {
                    $form->keyValue('options');
                })
                ->when(['text', 'email', 'url', 'mobile', 'ip'], function (Form $form) {
                    $form->switch('unique')->help('开启后，该字段的值将不能重复，如身份证号');
                })
                ->help('如果字段类型为下拉，单选，多选，此处需要设置选项值');
            $form->switch('required');
            $form->hidden('iflist')->value(1);
            // $form->switch('iflist')->help('是否在列表页显示此字段');
            $form->switch('show')->default(1)->help('是否启用');
            $form->text('default');
            $form->text('help');
            $form->number('sort')->default(1)->attribute('min', 1)->help('数字越大越靠前');

            $form->saving(function (Form $form) {
                if (!in_array($form->type,['select','radio','checkbox','multipleSelect'])) {
                    $form->deleteInput('options');
                }
            });
        });
    }
}
