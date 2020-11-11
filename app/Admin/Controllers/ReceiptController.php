<?php

namespace App\Admin\Controllers;

use App\Models\Receipt;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Models\Contract;
use Dcat\Admin\Admin;
use App\Models\Customer;
use App\Admin\Renderable\ContractTable;
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
                        4 => '现金',
                        5 => '卡券'
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
            if (Admin::user()->isRole('administrator')) {
                $top_titles = [
                    'id' => 'ID',
                    'updated_at' => '收款时间',
                    'receive' => '收款金额',
                    'paymethod' => '收款方式',
                    'billtype' => '票据类型',
                    'contract_id' => '所属合同',
                    'remark' => '备注'
                ];
                $grid->export($top_titles)->rows(function (array $rows) {
                    foreach ($rows as $index => &$row) {
                        $row['contract_id'] = Contract::find($row['contract_id'])->title;
                        switch ($row['paymethod']) {
                            case 1:
                                $row['paymethod'] = '银行转账';
                                break;
                            case 2:
                                $row['paymethod'] = '微信';
                                break;
                            case 3:
                                $row['paymethod'] = '支付宝';
                                break;
                            case 4:
                                 $row['paymethod'] = '现金';
                                break;
                            default:
                                 $row['paymethod'] = '卡券';
                        }
                        switch ($row['billtype']) {
                            case 1:
                                $row['billtype'] = '收据';
                                break;
                            case 2:
                                $row['billtype'] = '发票';
                                break;
                            default:
                                $row['billtype'] = '其他';
                        }
                    }
                    return $rows;
                });
            }

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
        return Form::make(Receipt::with('invoice'), function (Form $form) {
            // $Editing = $form->isEditing() && Admin::user()->id != Customer::find(Contract::find($form->model()->contract_id)->customer_id)->admin_users_id;
            // if ($Editing) {
            //     $customer = Customer::find($form->model()->id);
            //     $this->authorize('update', $customer);
            // }
            $form->display('id');
            $form->currency('receive')->symbol('￥');

            $form->select('paymethod', '收款方式')
                ->options(
                    [
                        1 => '银行转账',
                        2 => '微信',
                        3 => '支付宝',
                        4 => '现金',
                        5 => '卡券'
                    ]
                );

            $form->selectTable('contract_id')
                ->title('选择当前收款所属合同')
                ->dialogWidth('50%') // 弹窗宽度，默认 800px
                ->from(ContractTable::make(['id' => $form->getKey()])) // 设置渲染类实例，并传递自定义参数
                ->model(Contract::class, 'id', 'title'); // 设置编辑数据显示

            $form->text('remark');
            $form->datetime('updated_at');
            $form->radio('billtype', '是否开票')
                ->when(1, function (Form $form) {
                    // 值为1和4时显示文本框
                    $form->divider();

                    $form->currency('invoice.money', '开票金额');
                    $form->select('invoice.type', '开票类型')
                        ->options([
                            1 => '增值税普通发票',
                            2 => '增值税专用发票',
                            3 => '国税通用机打发票',
                            4 => '地税通用机打发票',
                            5 => '收据'
                        ]);
                    $form->hidden('invoice.state')->value(0);
                    $form->fieldset('发票信息', function (Form $form) {
                        $form->radio('invoice.title_type', '抬头类型')
                            ->when(1, function (Form $form) {
                                $form->text('invoice.tin', '纳税人识别号');
                                $form->text('invoice.bank_name', '开户行');
                                $form->text('invoice.bank_account', '开户账号');
                                $form->text('invoice.address', '开票地址');
                            })
                            ->options([
                                1 => '单位',
                                2 => '个人',
                            ])
                            ->default('1');
                        $form->text('invoice.title', '发票抬头');
                        $form->mobile('invoice.phone', '电话');
                    });

                    $form->fieldset('邮寄信息', function (Form $form) {
                        $form->text('invoice.contact_name', '联系人');
                        $form->mobile('invoice.contact_phone', '联系电话');
                        $form->text('invoice.contact_address', '邮寄地址');
                    });
                    $form->hidden('invoice.contract_id');
                })
                ->options(
                    [
                        0 => '不开票',
                        1 => '开票',
                    ]
                )->default('0');
            // $form->submitted(function (Form $form) {
            //     dd($form->input('contract_id'));
            //     $form->input('invoice.contract_id') = $form->input('contract_id');
            //     return $form->input('invoice.contract_id');
            // });
            $form->saving(function (Form $form) {
                $invoice = $form->invoice;
                $invoice['contract_id'] = $form->contract_id;
                $form->invoice = $invoice;
                if ($form->billtype == 0) {
                    $form->deleteInput('invoice.money');
                    $form->deleteInput('invoice.contract_id');
                    $form->deleteInput('invoice.type');
                    $form->deleteInput('invoice.state');
                    $form->deleteInput('invoice.title_type');
                    $form->deleteInput('invoice.tin');
                    $form->deleteInput('invoice.bank_name');
                    $form->deleteInput('invoice.bank_account');
                    $form->deleteInput('invoice.address');
                    $form->deleteInput('invoice.title');
                    $form->deleteInput('invoice.phone');
                    $form->deleteInput('invoice.contact_name');
                    $form->deleteInput('invoice.contact_phone');
                    $form->deleteInput('invoice.contact_address');
                }
                if ($form->receive) {
                    $form->receive = str_replace(',', '', $form->receive);
                }
                return $form;
            });
        });
    }
}
