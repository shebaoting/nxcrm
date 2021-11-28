<?php

namespace App\Admin\Controllers;

use App\Models\CrmCustomer;
use App\Models\Admin_user;
use App\Models\Role;
use App\Models\AdminRoleUsers;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use App\Models\CrmEvent;
use App\Admin\Traits\Customfields;
use Dcat\Admin\Layout\Content;
use App\Admin\Traits\ChangeUser;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Admin;
use App\Admin\Traits\ShareCustomers;
use App\Admin\Traits\Selector;
use App\Admin\RowAction\ChangeState;
use App\Admin\RowAction\ReceiveHighSeas;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;
use App\Admin\Traits\Exportfields;

class LeadController extends AdminController
{
    use Customfields, Selector, ShareCustomers, Exportfields, ChangeUser;

    public function __construct(Request $request)
    {
        $this->source_id = $request->source_id;
        return $this;
    }

    public static $editcss = [
        '/static/css/lead_edit.css',
    ];
    public static $showcss = [
        '/static/css/customer_show.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(CrmCustomer::with(['adminUser','CrmEvents']), function (Grid $grid) {


            Admin::style(
                <<<CSS
        .nav-tabs {
            background-color: #fff;
            margin-top: 20px;
            box-shadow: 0 2px 4px 0 rgba(0,0,0,.05);
            border-radius: .25rem;
        }
CSS
            );

            //取出当前用户为负责人的所有部门
            $leader = Role::where('leader', '=', Admin::user()->id)->pluck('id')->toArray();

            //取出当前用户为负责人的所有部门下的所有用户
            $roleUsers = AdminRoleUsers::whereIn('role_id', $leader)->pluck('user_id')->toArray();

            //判断当前用户是否为部门负责人
            $isleader = count($leader);
            if ((!$this->source_id || $this->source_id == 0)) {
                if(Admin::user()->isRole('administrator')){
                    $grid->model();
                }elseif ($isleader){
                    $grid->model()->whereIn('admin_user_id', $roleUsers);
                }
            } elseif ($this->source_id == 2) {
                $shares_Customer = array_column(Admin_user::find(Admin::user()->id)->SharesCustomer()->get()->toArray(), 'id');
                $grid->model()->whereIn('id', $shares_Customer);
            } elseif ($this->source_id == 3) {
                $grid->model()->where('admin_user_id', '=', 0);
            } else {
                $grid->model()->where('admin_user_id', '=', Admin::user()->id);
            }

            $grid->header(function () use ($isleader) {
                $tab = Tab::make();
                if (Admin::user()->isRole('administrator') || $isleader) {
                    $tab->addLink('所有线索', '?source_id=0', true);
                }
                $tab->addLink('我的线索', '?source_id=1', $this->source_id == 1 ? true : false);
                $tab->addLink('分享给我', '?source_id=2', $this->source_id == 2 ? true : false);
                $tab->addLink('公海线索', '?source_id=3', $this->source_id == 3 ? true : false);
                return $tab;
            });

            $grid->selector(function (Grid\Tools\Selector $selector) {
                $selector->selectOne('state', '状态', [
                    0 => '废弃',
                    1 => '正常',
                ]);
                $selector->select('id', '未跟进', ['3天未跟进', '1周未跟进', '半月未跟进', '1月未跟进', '2月未跟进', '半年未跟进'], function ($query, $value) {
                    $between = [
                        $this->queryCustomer(3),
                        $this->queryCustomer(7),
                        $this->queryCustomer(15),
                        $this->queryCustomer(30),
                        $this->queryCustomer(60),
                        $this->queryCustomer(180),
                    ];
                    $value = current($value);
                    $query->whereIn('id', $between[$value]);
                });
            });
            $grid->setDialogFormDimensions('700px', '420px');
            $grid->id->sortable();
            $grid->column('state', '状态')->using([
                0 => '废弃',
                1 => '正常',
            ])->label([
                '0' => 'gray',
                '1' => 'success',
            ]);
            $grid->column('events', '跟进')->display(function () {
                $Event = CrmEvent::where([['crm_customer_id', '=', $this->id]])->orderBy('updated_at', 'desc')->limit(1)->get();
                if (count($Event)) {
                    return $Event[0]['created_at']->diffForHumans();
                } else {
                    return '<span style="color:#ea5455">无跟进</span>';
                }
            });
            $grid->name('客户名称')->link(function () {
                return admin_url('leads/' . $this->id);
            });
            if (!in_array($this->source_id,[1,3])) {
                $grid->column('adminUser.name', '所属销售');
            }


            $grid->created_at;

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->row->admin_user_id != 0){
                    if ($actions->row->state == 1) {
                        $actions->append(new ChangeState(['Customer', '转为客户', '您确定要将此线索转化为正式客户吗', 3]));
                        $actions->append(new ChangeState(['Customer', '废弃', '确定废弃此线索吗？', 0]));
                    } else {
                        $actions->append(new ChangeState(['Customer', '恢复', '您确定要恢复此线索吗？', 1]));
                    }
                }else{
                    $actions->append(new ReceiveHighSeas(['领取线索', '您确定要领取此线索吗？']));
                }

            });

            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->disableDeleteButton();
            $grid->enableDialogCreate();
            $grid->disableBatchActions();
            $grid->disableViewButton();
            // $grid->disableEditButton();
            $grid->disableRefreshButton();
            $grid->toolsWithOutline(false);
            $grid->disableFilterButton();
            $grid->model()->orderBy('id', 'desc');
            $grid->model()->where('state', '!=', '3');
            $grid->quickSearch('id', 'name');

            if (Admin::user()->isRole('administrator')) {
                // 导出
                $this->Exportfield($grid, 'customer');

                // 导入
                $grid->tools('<a href="/admin/import/form" class="btn btn-primary pull-right"><i class="feather icon-arrow-down"></i>导入</a>');
            }

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

        Admin::css(static::$showcss);
        $customer = CrmCustomer::with(['CrmContacts','crmReceipts','crmInvoice', 'CrmContracts', 'adminUser', 'CrmEvents' => function ($q) {
            $q->orderBy('updated_at', 'desc');
        }, 'CrmEvents.CrmContact', 'CrmEvents.adminUser','crmOrders', 'Attachments', 'SharesUser'])->findorFail($id);
        // $fields = Customfield::where([['model', '=', 'customer'], ['show', '=', '1'],])->get();
        // 判断授权，无权限查看他人的信息,以后可以优化一下
        $detalling = ($customer->adminUser) ? (Admin::user()->id != $customer->id) : true;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $this->authorize('update', $customer);
        }
        $data = [
            'customer' => $customer,
            'contacts' => $customer->CrmContacts,
            'adminUser' => ($customer->adminUser) ?: '',
            'events' => $customer->CrmEvents,
            'contracts' => $customer->CrmContracts,
            'receipts' => $customer->crmReceipts,
            'invoices' => $customer->crmInvoice,
            'orders' => $customer->crmOrders,
            'attachments' => $customer->Attachments,
            'customerfields' => $this->custommodel('customer'),
            'contactfields' => $this->custommodel('contact'),
            // 'fields' => $fields,
            'Share' => ($customer->adminUser) ? ($this->Share($id)) : '',
            'Change' => $this->Change($id,'customer'),
            'shares_user' => $customer->SharesUser()->select(['name', 'avatar'])->get(),
            'events_contacts' => CrmCustomer::find($id)->with('CrmEvents.CrmContact'),
        ];
//        dd($this->Share($id));
        return $content
            ->title('线索')
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
        Admin::css(static::$editcss);
        $builder = CrmCustomer::with('CrmContacts');
        return Form::make($builder, function (Form $form) {
            // 判断授权，无权限编辑他人的信息,以后可以优化一下
            // dd($form->model()->admin_user_id);
            $Editing = $form->isEditing() && Admin::user()->id != $form->model()->admin_user_id;
            if ($Editing) {
                $customer = CrmCustomer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('name');
            $form->hidden('admin_user_id')->value(Admin::user()->id);
            $form->hidden('state')->value(0);

            $form->fieldset('联系人', function (Form $form) {
                $form->hasMany('crm_contacts', '联系人', function (Form\NestedForm $form) {
                    $form->text('name', '姓名');
                    $form->mobile('phone', '手机号');
                    // $form->hidden('customer_id')->value('id');
                });
            });
        });
    }
}
