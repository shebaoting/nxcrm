<?php

namespace App\Admin\Controllers;

use App\Models\Invoice;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class InvoiceController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Invoice(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('receipt_id');
            $grid->column('money');
            $grid->column('type');
            $grid->column('title_type');
            $grid->column('title');
            $grid->column('created_at');
            $grid->column('remark');
            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableQuickEditButton();
            $grid->disableCreateButton();
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
        return Show::make($id, new Invoice(), function (Show $show) {
            $show->field('id');
            $show->field('receipt_id');
            $show->field('money');
            $show->field('type');
            $show->field('remark');
            $show->field('title_type');
            $show->field('title');
            $show->field('tin');
            $show->field('bank_name');
            $show->field('bank_account');
            $show->field('address');
            $show->field('phone');
            $show->field('contact_name');
            $show->field('contact_phone');
            $show->field('contact_address');
            $show->field('created_at');
            $show->field('updated_at');
            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableList();
                    $tools->disableDelete();
                });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Invoice(), function (Form $form) {
            $form->display('id');
            $form->text('receipt_id');
            $form->text('money');
            $form->text('type');
            $form->text('remark');
            $form->text('title_type');
            $form->text('title');
            $form->text('tin');
            $form->text('bank_name');
            $form->text('bank_account');
            $form->text('address');
            $form->text('phone');
            $form->text('contact_name');
            $form->text('contact_phone');
            $form->text('contact_address');

            $form->display('created_at');
            $form->display('updated_at');

            $form->footer(function ($footer) {
                // 去掉`查看`checkbox
                $footer->disableViewCheck();
                // 去掉`继续编辑`checkbox
                $footer->disableEditingCheck();
                // 去掉`继续创建`checkbox
                $footer->disableCreatingCheck();
            });
            $form->tools(function (Form\Tools $tools) {
                // 去掉跳转列表按钮
                $tools->disableList();
                // 去掉删除按钮
                $tools->disableDelete();
            });
        });
    }
}
