<?php

namespace App\Admin\Controllers;

use App\Models\Attachment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Dcat\Admin\Http\Controllers\AdminController;

class AttachmentController extends AdminController
{
    public function __construct(Request $request)
    {
        $this->customerid = $request->customer_id;
        $this->contractid = $request->contract_id;
        $this->electronic = $request->electronic;
        $this->opportunityid = $request->opportunity_id;
        $this->invoiceid = $request->invoice_id;
        return $this;
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Attachment(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->files;
            $grid->crm_customer_id;
            $grid->crm_contract_id;
            $grid->electronic;
            $grid->created_at;
            $grid->updated_at->sortable();
            $grid->disableRefreshButton();
            $grid->toolsWithOutline(false);
            $grid->disableFilterButton();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
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
    protected function detail($id)
    {
        return Show::make($id, new Attachment(), function (Show $show) {
            $show->id;
            $show->files;
            $show->customer_id;
            $show->contract_id;
            $show->electronic;
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
        return Form::make(new Attachment(), function (Form $form) {
            $form->display('id');
            if ($this->electronic) {
                $form->hidden('electronic')->value($this->electronic);
                $form->multipleImage('files', '电子档')->limit(10)
                    ->accept('jpg,png,gif,jpeg')
                    ->withFormData(['crm_customer_id' => request('crm_customer_id')])->move($this->customerid . '/' . date('Ymd') . '/')

                    ->saving(function ($files) {
                        return json_encode($files);
                    });
            } else {
                $form->hidden('electronic')->value('0');
                $form->multipleFile('files', '附件')
                    ->accept('jpg,png,gif,jpeg,zip,doc,docx,pptx,xls,xlsx,txt,psd,pdf')
                    ->withFormData(['crm_customer_id' => request('crm_customer_id')])->move($this->customerid . '/' . date('Ymd') . '/')

                    ->saving(function ($files) {
                        return json_encode($files);
                    });
            }
            if ($this->contractid) {
                $form->hidden('crm_contract_id')->value($this->contractid);
            }
            $form->hidden('crm_customer_id')->value($this->customerid);
            $form->hidden('crm_opportunity_id')->value($this->opportunityid);
            $form->hidden('crm_invoice_id')->value($this->invoiceid);
            $form->display('created_at');
            $form->display('updated_at');
            $form->saving(function (Form $form) {
            // dd($form->files);
            });

            $form->saved(function (Form $form) {
                if ($form->crm_contract_id) {
                    return $form->response()->success('保存成功')->redirect('contracts/' . $form->crm_contract_id);
                } elseif ($form->crm_opportunity_id) {
                    return $form->response()->success('保存成功')->redirect('opportunitys/' . $form->crm_opportunity_id);
                } elseif ($form->crm_invoice_id) {
                    return $form->response()->success('保存成功')->redirect('invoices/' . $form->crm_invoice_id);
                } else {
                    return $form->response()->success('保存成功')->redirect('customers/' . $form->crm_customer_id);
                }
            });


            $form->deleted(function (Form $form) {
                return $form->redirect(back(), '删除成功');
            });
        });
    }
}
