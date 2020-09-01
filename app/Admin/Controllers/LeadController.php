<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\IFrameGrid;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Admin;

class LeadController extends AdminController
{

    public static $css = [
        '/static/css/lead_edit.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Customer::with(['admin_users']), function (Grid $grid) {
            if(!Admin::user()->isRole('administrator')){
                $grid->model()->where('admin_users_id', '=', Admin::user()->id);
            }
            $grid->setDialogFormDimensions('700px', '420px');
            $grid->id->sortable();
            $grid->name('客户名称')->link(function () {
                return admin_url('leads/'. $this->id.'/edit' );
            });
            $grid->column('admin_users.name','所属销售');
            $grid->state('状态')->select([
                0 => '待处理',
                1 => '跟进中',
                3 => '转为客户',
            ],true);
            $grid->created_at;
            $grid->enableDialogCreate();
            $grid->disableBatchActions();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->model()->orderBy('id', 'desc');
            $grid->model()->where('state', '!=', '3');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '客户名称');
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
        Admin::css(static::$css);
        $builder = Customer::with('contacts');
        return Form::make($builder, function (Form $form) {
            // 判断授权，无权限编辑他人的信息,以后可以优化一下
            // dd($form->model()->admin_users_id);
            $Editing = $form->isEditing() && Admin::user()->id != $form->model()->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('name');
            $form->hidden('admin_users_id')->value(Admin::user()->id);
            $form->hidden('state')->value(0);

            $form->fieldset('联系人', function (Form $form) {
                $form->hasMany('contacts','联系人', function (Form\NestedForm $form) {
                    $form->text('name','姓名');
                    $form->mobile('phone','手机号');
                    $form->text('position','职位');
                    $form->text('wechat','微信号');
                    // $form->hidden('customer_id')->value('id');
                });
            });


        });
    }

    protected function iFrameGrid()
    {
        $grid = new IFrameGrid(new Customer());
        // 如果表格数据中带有 “name”、“title”或“username”字段，则可以不用设置
        if(!Admin::user()->isRole('administrator')){
            $grid->model()->where('admin_users_id', '=', Admin::user()->id);
        }
        $grid->rowSelector()->titleColumn('name');
        $grid->id->sortable();
        $grid->name;
        $grid->disableRefreshButton();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->equal('id');
            $filter->like('name');
        });

        return $grid;
    }
}
