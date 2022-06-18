<?php

namespace App\Admin\Controllers;

use App\Models\CrmProgram;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Admin;

class ProgramController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CrmProgram(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('daily');
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
        return Show::make($id, new CrmProgram(), function (Show $show) {
            $show->field('id');
            $show->field('daily');
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
        Admin::style(
            <<<CSS
.col-md-2 {
    flex: 0 0 25%;
    max-width: 25%;
}
CSS
        );
        return Form::make(new CrmProgram(), function (Form $form) {
            $form->hidden('id');
            $form->hidden('admin_user_id');
            $form->hidden('daily');
            if ($form->isCreating()) {
                $daily = '{"add_contract": "0", "add_customer": "0", "add_opportunity": "0", "add_receipt_sum": "0", "add_contract_sum": "0.00", "add_opportunity_sum": "0.00"}';
                $daily = json_decode($daily);
            }else{
                $daily = json_decode($form->model()->daily);
            }

            // $form->divider('客户');
            // $form->number('add_lead', '新增线索数')->attribute('min', 1)->default(1);
            $form->number('add_customer', '新增客户数')->attribute('min', 1)->default(1)->value($daily->add_customer);
            // $form->divider('商机');
            $form->number('add_opportunity', '新增商机数')->attribute('min', 1)->default(1)->value($daily->add_opportunity);
            $form->currency('add_opportunity_sum', '新增商机金额')->symbol('￥')->value($daily->add_opportunity_sum);
            // $form->divider('合同');
            $form->number('add_contract', '新增合同数')->attribute('min', 1)->default(1)->value($daily->add_contract);
            $form->currency('add_contract_sum', '新增合同金额')->symbol('￥')->value($daily->add_contract_sum);
            // $form->divider('收款');
            $form->currency('add_receipt_sum', '新增收款金额')->symbol('￥')->value($daily->add_receipt_sum);
            $form->hidden('created_at');
            $form->hidden('updated_at');

            $form->saving(function (Form $form) {
                $daily = [];
                $daily['add_customer'] = $form->add_customer;
                $daily['add_opportunity'] = $form->add_opportunity;
                $daily['add_opportunity_sum'] = $form->add_opportunity_sum;
                $daily['add_contract'] = $form->add_contract;
                $daily['add_contract_sum'] = $form->add_contract_sum;
                $daily['add_receipt_sum'] = $form->add_receipt_sum;
                $form->daily = json_encode($daily);
                $form->admin_user_id = Admin::user()->id;

                $form->deleteInput('add_customer');
                $form->deleteInput('add_opportunity');
                $form->deleteInput('add_opportunity_sum');
                $form->deleteInput('add_contract');
                $form->deleteInput('add_contract_sum');
                $form->deleteInput('add_receipt_sum');
                // dd($form);
                return $form;
            });
        });
    }
}
