<?php

namespace App\Admin\Controllers;

use App\Models\Opportunity;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use App\Models\Customer;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;

class OpportunityController extends AdminController
{

    public static $css = [
        '/static/css/opportunity_show.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {


        if (!Admin::user()->isRole('administrator')) {
            $opportunity = Opportunity::whereHas('customer', function ($query) {
                $query->where('admin_users_id', Admin::user()->id);
            });
        }else{
            $opportunity = new Opportunity();
        }

        return Grid::make($opportunity, function (Grid $grid) {
            $grid->id->sortable();
            $grid->subject->link(function () {
                return admin_url('opportunitys/' . $this->id);
            });

            $grid->customer_id('所属客户')->display(function ($id) {
                return optional(Customer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->customer_id);
            });
            $grid->expectincome;
            $grid->expectendtime->sortable();
            $grid->dealchance;
            $grid->tempo
                ->using(
                    [
                        1 => '1-前期接触',
                        2 => '2-机会评估',
                        3 => '3-需求分析',
                        4 => '4-方案提供',
                        5 => '5-多方选择/评估'
                    ]
                );
            // $grid->remark;
            $grid->created_at;

            $grid->state('状态')->select([
                0 => '已失败',
                1 => '跟进中',
                2 => '成功',
            ],true);

            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('subject', '商机名称');
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
        $detalling = Admin::user()->id != Opportunity::find($id)->customer->admin_users->id;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = Opportunity::find($id);
            $this->authorize('update', $customer);
        }


        Admin::css(static::$css);
        $opportunity = Opportunity::query()->findorFail($id);
        $customer = Opportunity::find($id)->customer;
        $contacts = Customer::find(Opportunity::find($id)->customer_id)->contacts;
        $events = Customer::find($id)->events()->orderBy('updated_at', 'desc')->get();
        $attachments = Opportunity::find($id)->attachments()->orderBy('updated_at', 'desc')->get();
        $admin_users = Opportunity::find($id)->customer->admin_users;
        $data = [
            'opportunity' => $opportunity,
            'customer' => $customer,
            'contacts' => $contacts,
            'events' => $events,
            'attachments' => $attachments,
            'admin_users' => $admin_users,
        ];
        return $content
            ->title('商机')
            ->description('详情')
            ->body($this->_detail($data));
    }
    private function _detail($data)
    {
        return view('admin/opportunity/show', $data);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Opportunity(), function (Form $form) {


            $Editing = $form->isEditing() && Admin::user()->id != Customer::find($form->model()->customer_id)->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }

            $form->display('id');
            $form->text('subject');
            $form->selectResource('customer_id')
                ->path('customers') // 设置表格页面链接;
                ->multiple(1)
                ->options(function ($v) { // 显示已选中的数据
                    if (!$v) return $v;
                    return Customer::find($v)->pluck('name', 'id');
                });
            $form->currency('expectincome')->symbol('￥');
            $form->date('expectendtime');
            $form->slider('dealchance')->options(['max' => 100, 'min' => 1, 'step' => 10, 'postfix' => '%']);
            $form->select('tempo')->options([1 => '1-前期接触', 2 => '2-机会评估', 3 => '3-需求分析', 4 => '4-方案提供', 5 => '5-多方选择/评估']);
            $form->textarea('remark');
            $form->hidden('state')->value(1);
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form) {
                if($form->expectincome){
                    $form->expectincome = str_replace(',', '', $form->expectincome);
                }
                return $form->expectincome;
            });
        });
    }
}
