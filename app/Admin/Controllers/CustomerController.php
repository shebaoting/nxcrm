<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\IFrameGrid;
use App\Models\Customfield;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Admin;

class CustomerController extends AdminController
{

    public static $css = [
        '/static/css/customer_show.css',
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Customer::with(['admin_users']), function (Grid $grid) {
            if (!Admin::user()->isRole('administrator')) {
                $grid->model()->where('admin_users_id', '=', Admin::user()->id);
            }
            // $grid->enableDialogCreate();
            // $grid->setDialogFormDimensions('700px', '420px');
            $grid->id->sortable();
            $grid->name('客户名称')->link(function () {
                return admin_url('customers/' . $this->id);
            });
            // $grid->admin_users_id;
            $this->gridfield($grid);
            $grid->column('admin_users.name', '所属销售');
            $grid->model()->where('state', '=', '3');
            $grid->disableBatchActions();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '客户名称');
            });
            $top_titles = ['id' => 'ID', 'name' => '名称', 'admin_users_id' => '所属销售', 'address' => '地址'];
            $grid->export($top_titles)->rows(function (array $rows) {
                foreach ($rows as $index => &$row) {
                    $row['admin_users_id'] = Customer::find($row['admin_users_id'])->admin_users->name;
                }
                return $rows;
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
        // 判断授权，无权限查看他人的信息,以后可以优化一下
        $detalling = Admin::user()->id != Customer::find($id)->admin_users->id;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = Customer::find($id);
            $this->authorize('update', $customer);
        }


        Admin::css(static::$css);
        $customer = Customer::query()->findorFail($id);
        $contacts = Customer::find($id)->contacts;
        $contracts = Customer::find($id)->contracts;
        $admin_users = Customer::find($id)->admin_users;
        $events = Customer::find($id)->events()->orderBy('updated_at', 'desc')->get();
        $attachments = Customer::find($id)->attachments()->orderBy('updated_at', 'desc')->get();
        $data = [
            'customer' => $customer,
            'contacts' => $contacts,
            'admin_users' => $admin_users,
            'events' => $events,
            'contracts' => $contracts,
            'attachments' => $attachments,
            'fields' => $this->custommodel(),
        ];
        return $content
            ->title('客户')
            ->description('详情')
            ->body($this->_detail($data));
    }
    private function _detail($data)
    {
        return view('admin/customer/show', $data);
    }
    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Customer(), function (Form $form) {
            // 判断授权，无权限编辑他人的信息,以后可以优化一下
            // dd($form->model()->admin_users_id);
            $Editing = $form->isEditing() && Admin::user()->id != $form->model()->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('name');

            $this->formfield($form);
            $form->hidden('admin_users_id')->value(Admin::user()->id);
            $form->hidden('state')->value(3);
            $form->hidden('fields')->value(null);

            $form->saving(function (Form $form) {
                $form_field = array();
                foreach ($this->custommodel() as $field) {
                    $field_field = $field['field'];
                    $form_field[$field_field] = $form->$field_field;
                    $form->deleteInput($field['field']);
                }
                // dd(json_encode($form_field));
                $form->fields = json_encode($form_field);
            });
        });
    }

    protected function iFrameGrid()
    {
        $grid = new IFrameGrid(new Customer());
        // 如果表格数据中带有 “name”、“title”或“username”字段，则可以不用设置
        if (!Admin::user()->isRole('administrator')) {
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

    protected function custommodel()
    {
        $fields = Customfield::where([['model', '=', 'customer'], ['show', '=', '1']])->orderBy('sort', 'desc')->get();
        return $fields;
    }

    protected function gridfield(Grid $grid)
    {
        $fields = Customfield::where([['model', '=', 'customer'], ['show', '=', '1'], ['iflist', '=', '1']])->orderBy('sort', 'desc')->get();
        foreach ($fields as $field) {
            $grid->column($field['field'], $field['name'])->display(function () use ($field) {
                // dd($this->fields);
                $form_fields = json_decode($this->fields);
                $field_options = json_decode($field['options'], true);
                $field_field = $field['field'];
                if (isset($this->fields) && isset($form_fields->$field_field)) {
                    if (in_array($field['type'], ['select', 'radio'])) {
                        // dd($field_options);
                        $value = $field_options[$form_fields->$field_field];
                    } elseif (in_array($field['type'], ['checkbox', 'multipleSelect'])) {

                        $valuearr = [];
                        foreach (array_filter($form_fields->$field_field) as $k => $v) {
                            $valuearr[] = $field_options[$v];
                        }
                        $value = implode(" ", $valuearr);
                    } elseif (in_array($field['type'], ['switch'])) {
                        $value = $form_fields->$field_field ? '是' : '否';
                    } else {
                        $value = $form_fields->$field_field;
                    }
                } else {
                    $value = '';
                }
                return $value;
            });
        }
        return;
    }

    protected function formfield(Form $form)
    {
        foreach ($this->custommodel() as $field) {
            $field_type = $field['type'];
            $field_field = $field['field'];
            $field_name = $field['name'];
            $form_field = $form->$field_type($field_field, $field_name)->help($field['help']);


            // 如果是编辑状态，取出数据库的值
            if ($form->isEditing()) {
                $form_fields = json_decode($form->model()->fields);
                if (isset($form->model()->fields) && isset($form_fields->$field_field)) {
                    $form_fields_default = $form_fields->$field_field;
                } else {
                    $form_fields_default = '';
                }
            }
            if ($field['options']) {
                $field_options = json_decode($field['options'], true);
            }

            if ($field['required'] && $field['options']) {

                if ($form->isCreating()) {
                    $form_field->options($field_options)->required();
                } else {
                    $form_field->options($field_options)->default($form_fields_default, true)->required();
                }
            } elseif ($field['required']) {

                if ($form->isCreating()) {
                    $form_field->required();
                } elseif ($form->isEditing()) {
                    $form_field->value($form_fields_default)->required();
                }else {

                }
            } elseif ($field['options']) {


                if ($form->isCreating()) {
                    $form_field->options($field_options);
                } elseif ($form->isEditing()) {
                    $form_field->options($field_options)->default($form_fields_default, true);
                }else {

                }
            } else {

                if ($form->isCreating()) {
                    $form_field;
                } elseif ($form->isEditing()) {
                    $form_field->value($form_fields_default);
                }else {

                }
            }
        }
        return;
    }
}
