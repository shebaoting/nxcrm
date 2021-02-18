<?php

namespace App\Admin\Controllers;

use App\Models\CrmContact;
use App\Models\CrmCustomer;
use App\Admin\Traits\Customfields;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Admin;

class ContactController extends AdminController
{
    use Customfields;
    public function __construct(Request $request)
    {
        $this->customerid = $request->id;
        return $this;
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        if (!Admin::user()->isRole('administrator')) {
            $contact = CrmContact::whereHas('CrmCustomer', function ($query) {
                $query->where('admin_user_id', Admin::user()->id);
            });
        } else {
            $contact = new CrmContact();
        }
        return Grid::make($contact, function (Grid $grid) {
            $grid->showColumnSelector();
            $grid->enableDialogCreate();
            $grid->setDialogFormDimensions('700px', '420px');
            $grid->name('联系人名称')->link(function () {
                return admin_url('contacts/' . $this->id);
            });

            $grid->phone;

            $this->gridfield($grid,'contact');

            $grid->crm_customer_id('所属客户')->display(function ($id) {
                return optional(CrmCustomer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->customer_id);
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '联系人姓名');
            });
            $grid->model()->orderBy('id', 'desc');

            if (Admin::user()->isRole('administrator')) {
                $top_titles = ['id' => 'ID', 'name' => '姓名', 'crm_customer_id' => '公司名称', 'phone' => '电话', 'wechat' => '微信'];
                $grid->export($top_titles)->rows(function (array $rows) {
                    foreach ($rows as $index => &$row) {
                        $row['crm_customer_id'] = CrmCustomer::find($row['crm_customer_id'])->name;
                    }
                    return $rows;
                });
            }
            $grid->disableRefreshButton();
            $grid->disableCreateButton();
            $grid->disableBatchActions();
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            $grid->toolsWithOutline(false);
            $grid->disableFilterButton();
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

        $model = CrmContact::with('CrmCustomer');
        return Show::make($id, $model, function (Show $show) {
            // $show->id;
            $show->field('crm_customer.name', '客户名称');
            $show->name;
            $show->phone;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(CrmContact::with('CrmCustomer'), function (Form $form) {
            // 如果是新增状态
            if ($form->isCreating()) {
                $customerid = $this->customerid;
                $customername = optional(CrmCustomer::find($customerid))->name;
                $form->display('customer_false', '所属客户')->default($customername);
            } else {
                $customerid = $form->model()->customer_id;
                $customername = optional(CrmCustomer::find($customerid))->name;
                $form->display('CrmCustomer.name', '所属客户');
            }
            $form->text('name')->required();
            $form->mobile('phone');
            $this->formfield($form,'contact');
            $form->ignore(['customer_false']);
            $form->hidden('crm_customer_id')->value($customerid);
            $form->hidden('fields')->value(null);
            $class = $this;
            $form->saving(function (Form $form) use ($class) {
                $form_field = array();
                foreach ($class->custommodel('Contact') as $field) {
                    $field_field = $field['field'];
                    $form_field[$field_field] = $form->$field_field;
                    $form->deleteInput($field['field']);
                }
                // dd(json_encode($form_field));
                $form->fields = json_encode($form_field);
            });


            $form->saved(function (Form $form) {
                return $form->response()->success('保存成功')->redirect('customers/' . $form->customer_id);
            });

            $form->deleted(function (Form $form) {
                return $form->response()->success('删除成功')->redirect('contacts/');
            });
        });
    }
}
