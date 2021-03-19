<?php
namespace App\Admin\Renderable;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\CrmModelcontract;

class ModelContract extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make(new CrmModelcontract(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('title','合同范本');

            $grid->quickSearch(['id', 'title']);
            $grid->disableFilterButton();
            $grid->paginate(7);
            $grid->disableActions();
            $grid->model()->orderBy('id', 'desc');
        });
    }
}
