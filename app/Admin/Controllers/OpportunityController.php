<?php

namespace App\Admin\Controllers;

use App\Models\CrmOpportunity;
use App\Models\CrmEvent;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use App\Admin\Renderable\CrmCustomerTable;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Models\CrmCustomer;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use App\Admin\Traits\Selector;
use App\Admin\RowAction\ChangeState;

class OpportunityController extends AdminController
{
    use Selector;
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
                $query->where('admin_user_id', Admin::user()->id);
            });
        }else{
            $opportunity = new CrmOpportunity();
        }

        return Grid::make($opportunity, function (Grid $grid) {

            $grid->selector(function (Grid\Tools\Selector $selector) {
                $selector->select('tempo', '商机进度', [
                    1 => '1-前期接触',
                    2 => '2-机会评估',
                    3 => '3-需求分析',
                    4 => '4-方案提供',
                    5 => '5-多方选择/评估',
                ]);
                $selector->select('state', '状态', [
                    0 => '已失败',
                    1 => '跟进中',
                    2 => '成功',
                ]);
                $selector->select('id', '未跟进', ['3天未跟进', '1周未跟进', '半月未跟进', '1月未跟进', '2月未跟进', '半年未跟进'], function ($query, $value) {
                    $between = [
                        $this->queryOpportunity(3),
                        $this->queryOpportunity(7),
                        $this->queryOpportunity(15),
                        $this->queryOpportunity(30),
                        $this->queryOpportunity(60),
                        $this->queryOpportunity(180),
                    ];
                    $value = current($value);
                    $query->whereIn('id', $between[$value]);
                });
            });



            $grid->id->sortable();

            $grid->subject->link(function () {
                return admin_url('opportunitys/' . $this->id);
            });

            $grid->crm_customer_id('所属客户')->display(function ($id) {
                return optional(CrmCustomer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->crm_customer_id);
            });
            $grid->column('events', '跟进')->display(function () {
                $Event = CrmEvent::where([['crm_opportunity_id', '=', $this->id]])->orderBy('updated_at', 'desc')->limit(1)->get();
                if (count($Event)) {
                    return $Event[0]['created_at']->diffForHumans();
                } else {
                    return '<span style="color:#ea5455">无跟进</span>';
                }
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

            $grid->column('state', '状态')->using([
                0 => '废弃',
                1 => '跟进中',
                2 => '成功',
            ])->label([
                '0' => 'gray',
                '1' => 'blue1',
                '2' => 'success',
            ]);

            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
                $filter->like('subject', '商机名称');
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if ($actions->row->state == 1) {
                    $actions->append(new ChangeState(['Opportunity','标记成功', '您确定要将此商机标记为成功吗', 2]));
                    $actions->append(new ChangeState(['Opportunity','废弃', '确定废弃此商机吗？', 0]));
                } elseif ($actions->row->state == 2) {
                    $actions->append(new ChangeState(['Opportunity','撤销成功标记', '您确定要此商机恢复为跟进状态吗？', 1]));
                }else {
                    $actions->append(new ChangeState(['Opportunity','恢复', '您确定要此商机恢复为跟进状态吗？', 1]));
                }
            });


            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->disableDeleteButton();
            $grid->disableBatchActions();
            $grid->disableViewButton();
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


    public function show($id, Content $content)
    {
        // 判断授权，无权限查看他人的信息,以后可以优化一下
        $detalling = Admin::user()->id != CrmOpportunity::find($id)->CrmCustomer->Admin_user->id;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = CrmOpportunity::find($id);
            $this->authorize('update', $customer);
        }


        Admin::css(static::$css);
        $opportunity = CrmOpportunity::query()->findorFail($id);
        $customer = CrmOpportunity::find($id)->CrmCustomer;
        $contacts = CrmCustomer::find(CrmOpportunity::find($id)->crm_customer_id)->CrmContacts;
        $events = CrmEvent::where([['crm_customer_id', '=', $customer->id], ['crm_opportunity_id', '=', $id]])->orderBy('updated_at', 'desc')->get();
        $attachments = CrmOpportunity::find($id)->attachments()->orderBy('updated_at', 'desc')->get();
        $admin_user = CrmOpportunity::find($id)->CrmCustomer->Admin_user;
        $data = [
            'opportunity' => $opportunity,
            'customer' => $customer,
            'contacts' => $contacts,
            'events' => $events,
            'attachments' => $attachments,
            'admin_user' => $admin_user,
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
        return Form::make(new CrmOpportunity(), function (Form $form) {


            $Editing = $form->isEditing() && Admin::user()->id != CrmCustomer::find($form->model()->crm_customer_id)->admin_user_id;
            if ($Editing) {
                $customer = CrmCustomer::find($form->model()->id);
                $this->authorize('update', $customer);
            }

            $form->display('id');
            $form->text('subject');

            $form->selectTable('crm_customer_id')
            ->title('请选择所属客户')
            ->dialogWidth('50%') // 弹窗宽度，默认 800px
            ->from(CrmCustomerTable::make(['id' => $form->getKey()])) // 设置渲染类实例，并传递自定义参数
            ->model(CrmCustomer::class, 'id', 'name'); // 设置编辑数据显示


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
