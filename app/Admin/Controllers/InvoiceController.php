<?php

namespace App\Admin\Controllers;
use App\Models\Invoice;
use App\Models\Contract;
use Illuminate\Http\Request;
use Dcat\Admin\Show;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Admin;

class InvoiceController extends AdminController
{
    public static $js = [
        // js脚本不能直接包含初始化操作，否则页面刷新后无效
       'https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js',
   ];
    public static $css = [
        '/static/css/invoice_show.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Invoice(), function (Grid $grid) {
            $grid->column('receipt.contract_id','所属合同编号')->display(function($id) {
                return '<a href="contracts/'.Contract::find($id)->id.'">'.strtotime(Contract::find($id)->signdate).'</a>';
            });
            $grid->column('id','发票编号')->display(function($id) {
                return '<a href="invoices/'.$id.'">'.strtotime($this->created_at).'</a>';
            });
            $grid->column('created_at','申请时间');
            $grid->model()->with(['receipt']);
            $grid->state
            ->using(
                [
                    0 => '未开票',
                    1 => '已开票',
                    2 => '已领取',
                    3 => '已驳回',
                    4 => '已作废',
                ]
            )->dot(
                [
                    0 => 'dark85',
                    1 => 'blue',
                    2 => 'green',
                    3 => 'red-darker',
                    4 => 'dark',
                ],
                'dark85' // 第二个参数为默认值
            );
            $grid->column('money');
            $grid->column('title');
            $grid->column('remark');

            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableQuickEditButton();
            $grid->disableCreateButton();
            $grid->model()->orderBy('id', 'desc');
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

    public function show($id, Content $content)
    {

        Admin::css(static::$css);
        Admin::js(static::$js);
        $invoice = Invoice::query()->findorFail($id);
        $contract = Invoice::find($id)->Receipt->Contract;
        $receipt = Invoice::find($id)->Receipt;
        $customer = Invoice::find($id)->Receipt->Contract->Customer;
        $attachments= Invoice::find($id)->attachments()->orderBy('updated_at', 'desc')->get();
        $contractid= Invoice::find($id)->Receipt->Contract->id;
        $receipts = Contract::find($contractid)->Receipts;
        $invoices = Contract::find($contractid)->Invoices;

        $receipt_sum = 0;
        foreach ($receipts as $value) {
            $receipt_sum += $value->receive;
        }

        $invoice_sum = 0;
        foreach ($invoices as $value) {
            if ($value->state == 1) {
                $invoice_sum += $value->money;
            }
        }

        $data = [
            'invoice' => $invoice,
            'contract'=> $contract,
            'receipt'=> $receipt,
            'customer'=> $customer,
            'attachments'=> $attachments,
            'receipt_sum'=> $receipt_sum,
            'invoice_sum'=> $invoice_sum,
        ];
        return $content
        ->title('发票')
        ->description('详情')
        ->body($this->_detail($data));
    }
    private function _detail ($data)
    {
        return view('admin/invoice/show',$data);
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

    protected function state(Invoice $invoice, Request $request)
    {
        $request->validate([
            'state' => 'required|max:1)'
        ]);
        $invoice->update([
            'state' => $request->state,
        ]);
        admin_toastr('更新成功', 'success');
        return redirect()->route('invoices.show', $invoice->id);
    }
}
