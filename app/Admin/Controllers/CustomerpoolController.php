<?php

namespace App\Admin\Controllers;

use App\Models\CrmCustomerpool;
use App\Models\Role;
use App\Admin\Renderable\UserTable;
use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CustomerpoolController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CrmCustomerpool(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('roles')->display(function ($leader) {
                $leader = json_decode($leader);
                return $leader ? Role::find($leader)->pluck('name') : '未设置';
            })->label('primary', 3);
            $grid->column('leader')->display(function ($leader) {
                return $leader ? Administrator::find($leader)->name : '未设置';
            })->label('primary');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new CrmCustomerpool(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('roles');
            $show->field('leader');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new CrmCustomerpool(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->checkbox('roles')
            ->options(Role::all()->pluck('name', 'id'))
            ->saving(function ($value) {
                // 转化成json字符串保存到数据库
                return json_encode($value);
            });
            $form->selectTable('leader','负责人')
            ->title('选择公海池负责人')
            ->dialogWidth('30%') // 弹窗宽度，默认 800px
            ->from(UserTable::make(['id' => $form->getKey()])) // 设置渲染类实例，并传递自定义参数
            ->model(Administrator::class, 'id', 'name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
