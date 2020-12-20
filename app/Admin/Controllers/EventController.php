<?php

namespace App\Admin\Controllers;

use App\Models\Event;
use App\Models\Contact;
use App\Models\Customer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
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
                return optional(Customer::find($id))->name;
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
            $grid->disableCreateButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->disableViewButton();
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
        return Form::make(Event::with(['contact','admin_user']), function (Form $form) {
            $Editing = $form->isEditing() && Admin::user()->id != Customer::find($form->model()->customer_id)->admin_users_id;
            if ($Editing) {
                $customer = Customer::find($form->model()->id);
                $this->authorize('update', $customer);
            }
            $form->display('id');
            $form->text('content');
            $form->text('customer_id')->type('number');
            $form->text('contact_id')->type('number');
            $form->text('contract_id')->type('number');
            $form->text('opportunity_id')->type('number');
            $form->text('admin_user_id')->type('number');
            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form) {
                if ($form->opportunity_id) {
                    return $form->response()->success('发布成功')->redirect('opportunitys/' . $form->opportunity_id);
                } elseif ($form->contract_id) {
                    return $form->response()->success('发布成功')->redirect('contracts/' . $form->contract_id);
                }else {
                    return $form->response()->success('发布成功')->redirect('customers/' . $form->customer_id);
                }

            });

            $form->deleted(function (Form $form, $result) {
                // 通过 $result 可以判断数据是否删除成功
                return $form->response()->success('删除成功')->redirect('customers/' . $form->customer_id);
            });
        });
    }
}
