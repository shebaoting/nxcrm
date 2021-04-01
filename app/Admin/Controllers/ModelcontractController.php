<?php

namespace App\Admin\Controllers;

use App\Models\CrmModelcontract;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Support\JavaScript;
use Dcat\Admin\Http\Controllers\AdminController;

class ModelcontractController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CrmModelcontract(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('description');
            // $grid->column('created_at');
            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new CrmModelcontract(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('description');
            $show->field('content')->file();
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new CrmModelcontract(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->text('description');
            $form->file('content')->accept('docx')->rules('mimes:docx')->autoUpload()->uniqueName()->removable();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
