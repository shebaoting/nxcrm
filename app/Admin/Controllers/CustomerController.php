<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\IFrameGrid;
use App\Models\Event;
use Dcat\Admin\Widgets\Card;
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
            if(!Admin::user()->isRole('administrator')){
                $grid->model()->where('admin_users_id', '=', Admin::user()->id);
            }
            $grid->enableDialogCreate();
            $grid->setDialogFormDimensions('700px', '420px');
            $grid->id->sortable();
            $grid->name('客户名称')->link(function () {
                return admin_url('customers/'.$this->id);
            });
            $grid->email;
            $grid->url;
            $grid->address;
            // $grid->admin_users_id;

            $grid->column('admin_users.name','所属销售');
            $grid->model()->where('state', '=', '3');
            $grid->disableBatchActions();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('name', '客户名称');
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
        ];
        return $content
        ->title('客户')
        ->description('详情')
        ->body($this->_detail($data));
    }
    private function _detail ($data)
    {
        return view('admin/customer/show',$data);
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
            $form->email('email');
            $form->url('url')->value('http://');
            $form->text('address');
            $form->hidden('admin_users_id')->value(Admin::user()->id);
            $form->hidden('state')->value(3);
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
