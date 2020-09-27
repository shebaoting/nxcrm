<?php

namespace App\Admin\Controllers;

use App\Models\Contract;
use App\Models\Product;
use App\Admin\Renderable\CustomerTable;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Admin;
use App\Models\Customer;
use Dcat\Admin\IFrameGrid;

class ContractController extends AdminController
{
    public static $css = [
        '/static/css/contract_show.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        // dd(date("Y-m-d", strtotime("-7 day")));

        if (!Admin::user()->isRole('administrator')) {
            $contract = Contract::whereHas('customer', function ($query) {
                $query->where('admin_users_id', Admin::user()->id);
            })->with(['receipts']);
        } else {
            $contract = Contract::with(['receipts']);
        }

        return Grid::make($contract, function (Grid $grid) {

            $grid->selector(function (Grid\Tools\Selector $selector) {
                $selector->select('status', '状态', [
                    1 => '未开始',
                    2 => '执行中',
                    3 => '正常结束',
                    4 => '意外终止',
                ]);
                $selector->select('signdate', '签订日期', ['3天内', '7天内', '15天内', '1月内', '2月内'], function ($query, $value) {
                    $between = [
                        [date("Y-m-d", strtotime("-3 day")), date("Y-m-d")],
                        [date("Y-m-d", strtotime("-7 day")), date("Y-m-d")],
                        [date("Y-m-d", strtotime("-15 day")), date("Y-m-d")],
                        [date("Y-m-d", strtotime("-1 month")), date("Y-m-d")],
                        [date("Y-m-d", strtotime("-2 month")), date("Y-m-d")],
                    ];

                    $value = current($value);
                    $query->whereBetween('signdate', $between[$value]);
                });
                $selector->select('expiretime', '到期时间', ['3天内', '7天内', '15天内', '1月内', '2月内'], function ($query, $value) {
                    $between = [
                        [date("Y-m-d"), date("Y-m-d", strtotime("+3 day"))],
                        [date("Y-m-d"), date("Y-m-d", strtotime("+7 day"))],
                        [date("Y-m-d"), date("Y-m-d", strtotime("+15 day"))],
                        [date("Y-m-d"), date("Y-m-d", strtotime("+1 month"))],
                        [date("Y-m-d"), date("Y-m-d", strtotime("+2 month"))],
                    ];

                    $value = current($value);
                    $query->whereBetween('expiretime', $between[$value]);
                });
            });


            $grid->status
                ->using(
                    [
                        1 => '未开始',
                        2 => '执行中',
                        3 => '正常结束',
                        4 => '意外终止'
                    ]
                )->dot(
                    [
                        1 => 'dark85',
                        2 => 'green',
                        3 => 'dark',
                        4 => 'red-darker',
                    ],
                    'dark85' // 第二个参数为默认值
                );

            $grid->title->link(function () {
                return admin_url('contracts/' . $this->id);
            });
            $grid->customer_id('所属客户')->display(function ($id) {
                return optional(Customer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->customer_id);
            });
            $grid->signdate->sortable();
            $grid->expiretime->sortable();
            $grid->total;
            $grid->receipts->display(function ($receipts) {
                $count = count($receipts);
                if ($count) {
                    $accepts = 0;
                    foreach ($receipts as $value) {
                        $accepts += $value['receive'];
                    }
                } else {
                    $accepts = 0;
                }

                if ($this->total - $accepts) {
                    $payback = $this->total - $accepts;
                    $payback = "<span style='font-weight: 700;' class='text-danger'>$payback</span>";
                } else {
                    $payback = "<span style='font-weight: 700;' class='text-primary'>已结清</span>";
                }
                return $payback;
            });

            if (Admin::user()->isRole('administrator')) {
                $top_titles = [
                    'id' => 'ID',
                    'title' => '合同名称',
                    'customer_id' => '所属客户',
                    'signdate' => '签订日期',
                    'expiretime' => '到期时间',
                    'total' => '合同总额',
                    'status' => '合同状态'
                ];
                $grid->export($top_titles)->rows(function (array $rows) {
                    foreach ($rows as $index => &$row) {
                        $row['customer_id'] = Customer::find($row['customer_id'])->name;
                        switch ($row['status']) {
                            case 1:
                                $row['status'] = '未开始';
                                break;
                            case 2:
                                $row['status'] = '执行中';
                                break;
                            case 3:
                                $row['status'] = '正常结束';
                                break;
                            default:
                                $row['status'] = '意外终止';
                        }
                    }
                    return $rows;
                });
            }

            $grid->model()->orderBy('id', 'desc');
            $grid->disableBatchActions();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('title', '合同名称');
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

    public function show($id, Content $content)
    {

        $detalling = Admin::user()->id != Contract::find($id)->customer->admin_users->id;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $Contract = Contract::find($id);
            $this->authorize('update', $Contract);
        }

        Admin::css(static::$css);
        $contract = Contract::query()->findorFail($id);
        $customer = Contract::find($id)->customer;
        $receipts = Contract::find($id)->receipts;
        $events = Contract::find($id)->events;
        $attachments = Contract::find($id)->attachments()->orderBy('updated_at', 'desc')->get();
        $admin_users = Contract::find($id)->customer->admin_users;
        $accept = json_decode($receipts);
        $accepts = 0;
        foreach ($accept as $value) {
            $accepts += $value->receive;
        }

        $data = [
            'contract' => $contract,
            'customer' => $customer,
            'receipts' => $receipts,
            'accepts' => $accepts,
            'events' => $events,
            'admin_users' => $admin_users,
            'attachments' => $attachments,
        ];
        return $content
            ->title('合同')
            ->description('详情')
            ->body($this->_detail($data));
    }
    private function _detail($data)
    {
        return view('admin/contract/show', $data);
    }



    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Contract(), function (Form $form) {
            // $Editing = $form->isEditing() && Admin::user()->id != Customer::find($form->model()->customer_id)->admin_users_id;
            // if ($Editing) {
            //     $customer = Customer::find($form->model()->id);
            //     $this->authorize('update', $customer);
            // }

            Admin::css(static::$css);


            $form->column(6, function (Form $form) {
                $form->text('title')->required();
                $form->selectTable('customer_id')
                    ->title('弹窗标题')
                    ->dialogWidth('50%') // 弹窗宽度，默认 800px
                    ->from(CustomerTable::make(['id' => $form->getKey()])) // 设置渲染类实例，并传递自定义参数
                    ->model(Customer::class, 'id', 'name'); // 设置编辑数据显示
                $form->date('signdate', '签署时间')->required();
            });


            $form->column(6, function (Form $form) {
                $form->display('id');
                $form->select('status', '合同状态')->options([1 => '未开始', 2 => '执行中', 3 => '正常结束', 4 => '意外终止']);
                $form->date('expiretime', '到期时间')->required();
            });



            $form->column(12, function (Form $form) {
                $form->table('order', '订单', function ($table) {
                    // $table->select('prodname', '产品')->options(Product::pluck('name', 'id'));
                    $table->select('prodname', '产品')->options(Product::pluck('name', 'id'));
                    $table->hidden('prodprice', '标准价');
                    $table->currency('executionprice', '成交单价')->symbol('￥');
                    $table->number('quantity', '数量')->attribute('min', 1)->default(1);
                    // $table->text('unit', '单位')->disable();
                })->saving(function ($v) {
                    return json_encode($v);
                });
            });

            // $form->column(12, function (Form $form) {
            //     $form->html('
            //     <div class="fill">
            //         <span class="xcm">合计成交价</span>
            //         <span class="xco fsm">￥</span>
            //         <em class="xco fsl" id="ctrt_prod_total">0</em>
            //     </div>
            //     ');
            // });

            $form->column(6, function (Form $form) {
                $form->currency('total', '合同金额')->symbol('￥')->attribute('min', 0)->default(0);
            });

            $form->column(6, function (Form $form) {
                $form->currency('salesexpenses', '商务费用')->symbol('￥')->attribute('min', 0)->default(0);
            });

            $form->column(12, function (Form $form) {
                $form->textarea('remark', '备注');
            });


            $form->saving(function (Form $form) {
                if ($form->salesexpenses || $form->total) {
                    $form->salesexpenses = str_replace(',', '', $form->salesexpenses);
                    $form->total = str_replace(',', '', $form->total);
                }
                $order = $form->order;
                foreach ($order as $key => $value) {
                    $productid = $order[$key]['prodname'];
                    $order[$key]['executionprice'] = str_replace(',', '', $order[$key]['executionprice']);
                    $order[$key]['prodprice'] = Product::find($productid)->price;
                }
                $form->order = $order;
                return $form;
            });
        });
    }
}
