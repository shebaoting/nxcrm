<?php

namespace App\Admin\Controllers;

use App\Models\Event;
use App\Models\Contact;
use App\Models\Customer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Controllers\AdminController;

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
            $event = Event::whereHas('customer', function ($query) {
                $query->where('admin_users_id', Admin::user()->id);
            });
        } else {
            $event = new Event();
        }

        return Grid::make($event, function (Grid $grid) {
            $grid->id->sortable();
            $grid->content->width('50%');

            $grid->customer_id('所属客户')->display(function ($id) {
                return Customer::find($id)->name;
            })->link(function () {
                return admin_url('customers/' . $this->customer_id);
            });

            $grid->contact_id('联系人')->display(function ($id) {
                return optional(Contact::find($id))->name;
            })->link(function () {
                return admin_url('contacts/' . $this->contact_id);
            });

            $grid->created_at->sortable();
            $grid->disableBatchActions();
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
        $detalling = Admin::user()->id != Customer::find(Event::find($id)->customer->id)->admin_users->id;;
        $Role = !Admin::user()->isRole('administrator');
        if ($Role && $detalling) {
            $customer = Customer::find($id);
            $this->authorize('update', $customer);
        }
        return Show::make($id, new Event(), function (Show $show) {
            $show->id;
            $show->content;
            $show->customer_id;
            $show->contact_id;
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
        return Form::make(new Event(), function (Form $form) {
            $Editing = $form->isEditing() && Admin::user()->id != Customer::find($form->model()->customer_id)->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('content');
            $form->text('customer_id');
            $form->text('contact_id');
            $form->text('contract_id');
            $form->text('opportunity_id');
            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form) {
                if ($form->opportunity_id) {
                    return $form->redirect('opportunitys/' . $form->opportunity_id, '保存成功');
                } elseif ($form->contract_id) {
                    return $form->redirect('contracts/' . $form->contract_id, '保存成功');
                }else {
                    return $form->redirect('customers/' . $form->customer_id, '保存成功');
                }
                
            });

            $form->deleted(function (Form $form, $result) {
                // 通过 $result 可以判断数据是否删除成功
                return $form->redirect('customers/' . $form->customer_id, '删除成功');
            });
        });
    }
}
