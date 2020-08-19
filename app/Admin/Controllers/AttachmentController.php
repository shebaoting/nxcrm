<?php

namespace App\Admin\Controllers;

use App\Models\Attachment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Http\Request;
use Dcat\Admin\Controllers\AdminController;

class AttachmentController extends AdminController
{
    public function __construct(Request $request)
    {
        $this->customerid = $request->customer_id;
        $this->contractid = $request->contract_id;
        $this->electronic = $request->electronic;
        $this->opportunityid = $request->opportunity_id;
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
            $grid->customer_id;
            $grid->contract_id;
            $grid->electronic;
            $grid->created_at;
            $grid->updated_at->sortable();

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
                    ->withFormData(['customer_id' => request('customer_id')])->move($this->customerid . '/' . date('Ymd') . '/')

                    ->saving(function ($files) {
                        return json_encode($files);
                    });
            } else {
                $form->hidden('electronic')->value('0');
                $form->multipleFile('files', '附件')
                    ->accept('jpg,png,gif,jpeg,zip,doc,docx,pptx,xls,xlsx,txt,psd')
                    ->withFormData(['customer_id' => request('customer_id')])->move($this->customerid . '/' . date('Ymd') . '/')

                    ->saving(function ($files) {
                        return json_encode($files);
                    });
            }
            if ($this->contractid) {
                $form->hidden('contract_id')->value($this->contractid);
            }
            $form->hidden('customer_id')->value($this->customerid);
            $form->hidden('opportunity_id')->value($this->opportunityid);
            $form->display('created_at');
            $form->display('updated_at');

            $form->saved(function (Form $form) {
                if ($this->contractid) {
                    return $form->redirect('contracts/' . $form->contract_id, '保存成功');
                } elseif ($this->opportunityid) {
                    return $form->redirect('opportunitys/' . $form->opportunity_id, '保存成功');
                } else {
                    return $form->redirect('customers/' . $form->customer_id, '保存成功');
                }
            });


            $form->deleted(function (Form $form) {
                return $form->redirect(back(), '删除成功');
            });
        });
    }
}
