<?php
namespace App\Admin\Renderable;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\CrmContract;
use App\Models\CrmCustomer;

class ContractTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;

        return Grid::make(new CrmContract(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('title','合同标题');
            // $grid->column('customer_id','所属客户');

            $grid->column('crm_customer_id','所属客户')->display(function($Id) {
                return CrmCustomer::find($Id)->name;
            });
            $grid->column('signdate','签订日期');
            $grid->rowSelector()->titleColumn('title');

            $grid->quickSearch(['id', 'title', 'crm_customer_id']);

            $grid->paginate(5);
            $grid->disableActions();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('id')->width(4);
                $filter->like('title')->width(20);
                $filter->like('crm_customer_id')->width(4);
            });
        });
    }
}
