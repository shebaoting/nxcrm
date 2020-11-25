<?php

namespace App\Admin\Controllers;

use App\Models\Contact;
use App\Models\Customer;
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
            $contact = Contact::whereHas('customer', function ($query) {
                $query->where('admin_users_id', Admin::user()->id);
            });
        } else {
            $contact = new Contact();
        }
        return Grid::make($contact, function (Grid $grid) {

            $grid->enableDialogCreate();
            $grid->setDialogFormDimensions('700px', '420px');
            $grid->name('联系人名称')->link(function () {
                return admin_url('contacts/' . $this->id);
            });

            $grid->phone;

            $this->gridfield($grid,'contact');

            $grid->customer_id('所属客户')->display(function ($id) {
                return optional(Customer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->customer_id);
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '联系人姓名');
            });
            $grid->model()->orderBy('id', 'desc');

            if (Admin::user()->isRole('administrator')) {
                $top_titles = ['id' => 'ID', 'name' => '姓名', 'gender' => '性别', 'position' => '职位', 'customer_id' => '公司名称', 'phone' => '电话', 'wechat' => '微信'];
                $grid->export($top_titles)->rows(function (array $rows) {
                    foreach ($rows as $index => &$row) {
                        $row['customer_id'] = Customer::find($row['customer_id'])->name;
                        $row['gender'] = $row['gender'] ? '女' : '男';
                    }
                    return $rows;
                });
            }

            $grid->disableCreateButton();
            $grid->disableBatchActions();
            $grid->disableDeleteButton();
            $grid->disableEditButton();
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

        $model = Contact::with('customer');
        return Show::make($id, $model, function (Show $show) {
            // $show->id;
            $show->field('customer.name', '客户名称');
            $show->name;
            $show->phone;
            $show->position;
            $show->gender()->using(['0' => '男', '1' => '女']);
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(Contact::with('customer'), function (Form $form) {
            // 如果是新增状态
            if ($form->isCreating()) {
                $customerid = $this->customerid;
                $customername = optional(Customer::find($customerid))->name;
                $form->display('customer_false', '所属客户')->default($customername);
            } else {
                $customerid = $form->model()->customer_id;
                $customername = optional(Customer::find($customerid))->name;
                $form->display('customer.name', '所属客户');
            }
            $form->text('name')->required();
            $form->mobile('phone');
            $this->formfield($form,'contact');
            $form->ignore(['customer_false']);
            $form->hidden('customer_id')->value($customerid);
            $form->hidden('fields')->value(null);
            $class = $this;
            $form->saving(function (Form $form) use ($class) {
                $form_field = array();
                foreach ($class->custommodel('contact') as $field) {
                    $field_field = $field['field'];
                    $form_field[$field_field] = $form->$field_field;
                    $form->deleteInput($field['field']);
                }
                // dd(json_encode($form_field));
                $form->fields = json_encode($form_field);
            });


            $form->saved(function (Form $form) {
                return $form->redirect('customers/' . $form->customer_id, '保存成功');
            });

            $form->deleted(function (Form $form) {
                return $form->redirect(back(), '删除成功');
            });
        });
    }
}
