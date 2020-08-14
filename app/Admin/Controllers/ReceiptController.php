<?php

namespace App\Admin\Controllers;

use App\Models\Receipt;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\Contract;
use Dcat\Admin\Admin;
use App\Models\Customer;
use Dcat\Admin\Controllers\AdminController;

class ReceiptController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Receipt(), function (Grid $grid) {
            $grid->updated_at->sortable();
            $grid->receive;
            $grid->paymethod
                ->using(
                    [
                        1 => '银行转账',
                        2 => '微信',
                        3 => '支付宝',
                        4 => '现金'
                    ]
                );
            $grid->billtype
                ->using(
                    [
                        1 => '收据',
                        2 => '发票',
                        3 => '其他',
                    ]
                );
            $grid->contract_id('所属合同')->display(function ($id) {
                return optional(Contract::find($id))->title;
            })->link(function () {
                return admin_url('contracts/' . $this->contract_id);
            });


            $grid->remark;
            $grid->disableDeleteButton();
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
        $detalling = Admin::user()->id != Customer::find(Receipt::find($id)->contract->customer_id)->admin_users->id;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = Customer::find($id);
            $this->authorize('update', $customer);
        }

        return Show::make($id, new Receipt(), function (Show $show) {
            $show->id;
            $show->receive;
            $show->paymethod;
            $show->billtype;
            $show->contract_id;
            $show->remark;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Receipt(), function (Form $form) {
            $Editing = $form->isEditing() && Admin::user()->id != Customer::find(Contract::find($form->model()->contract_id)->customer_id)->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->currency('receive')->symbol('￥');

            $form->select('paymethod', '收款方式')
                ->options(
                    [
                        1 => '银行转账',
                        2 => '微信',
                        3 => '支付宝',
                        4 => '现金'
                    ]
                );

            $form->select('billtype', '票据类型')
                ->options(
                    [
                        1 => '收据',
                        2 => '发票',
                        3 => '其他',
                    ]
                );

            $form->selectResource('contract_id')
            ->path('contracts') // 设置表格页面链接;
            ->multiple(1)
            ->options(function ($v) { // 显示已选中的数据
                if (!$v) return $v;
                return Contract::find($v)->pluck('title', 'id');
            });

            $form->text('remark');
            $form->datetime('updated_at');

            $form->saving(function (Form $form) {
                if($form->receive){
                    $form->receive = str_replace(',', '', $form->receive);
                }
                return $form->receive;
            });

        });
    }
}
