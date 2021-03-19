<?php

namespace App\Admin\Controllers;

use App\Models\CrmEvent;
use App\Models\CrmContact;
use App\Models\CrmCustomer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use App\Models\Admin_user;
use Dcat\Admin\Http\Controllers\AdminController;

class EventController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        if (!Admin::user()->isRole('administrator')) {
            $event = CrmEvent::whereHas('CrmCustomer', function ($query) {
                $query->where('admin_user_id', Admin::user()->id);
            });
        } else {
            $event = new CrmEvent();
        }

        return Grid::make($event, function (Grid $grid) {
            $grid->id->sortable();
            $grid->content->width('30%');


            $grid->admin_user_id('跟进人员')->display(function ($id) {
                return optional(Admin_user::find($id))->name;
            });


            $grid->crm_customer_id('所属客户')->display(function ($id) {
                return optional(CrmCustomer::find($id))->name;
            })->link(function () {
                return admin_url('customers/' . $this->crm_customer_id);
            });

            $grid->crm_contact_id('联系人')->display(function ($id) {
                return optional(CrmContact::find($id))->name;
            })->link(function () {
                return admin_url('contacts/' . $this->crm_contact_id);
            });

            $grid->created_at('跟进时间')->sortable();
            $grid->disableBatchActions();
            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableViewButton();
            $grid->disableRefreshButton();
            $grid->toolsWithOutline(false);
            $grid->disableFilterButton();
            $grid->disableActions();
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
            $grid->model()->orderBy('id', 'desc');
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
        $detalling = Admin::user()->id != CrmCustomer::find(CrmEvent::find($id)->CrmCustomer->id)->adminUser->id;;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = CrmCustomer::find($id);
            $this->authorize('update', $customer);
        }
        return Show::make($id, new CrmEvent(), function (Show $show) {
            $show->id;
            $show->content;
            $show->crm_customer_id;
            $show->crm_contact_id;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(CrmEvent::with(['CrmContact','adminUser']), function (Form $form) {
            $Editing = $form->isEditing() && Admin::user()->id != CrmCustomer::find($form->model()->crm_customer_id)->admin_user_id;
            if ($Editing) {
                $customer = CrmCustomer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('content');
            $form->text('crm_customer_id')->type('number');
            $form->text('crm_contact_id')->type('number');
            $form->text('crm_contract_id')->type('number');
            $form->text('crm_opportunity_id')->type('number');
            $form->text('admin_user_id')->type('number');
            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form) {
                if ($form->crm_opportunity_id) {
                    return $form->response()->success('发布成功')->redirect('opportunitys/' . $form->crm_opportunity_id);
                } elseif ($form->crm_contract_id) {
                    return $form->response()->success('发布成功')->redirect('contracts/' . $form->crm_contract_id);
                }else {
                    return $form->response()->success('发布成功')->redirect('customers/' . $form->crm_customer_id);
                }

            });

            $form->deleted(function (Form $form, $result) {
                // 通过 $result 可以判断数据是否删除成功
                return $form->response()->success('删除成功')->redirect('customers/' . $form->crm_customer_id);
            });
        });
    }
}
