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
        if ($id){
            $crmContract = (new CrmContract())->where(['id'=>$id]);
        }else{
            $crmContract = new CrmContract();
        }

        return Grid::make($crmContract, function (Grid $grid)use($id) {
            $grid->column('id');
            $grid->column('title','合同标题')->display(function($title) {
                return optional(CrmCustomer::find($this->crm_customer_id))->name.'#'.$this->id;
            });
            // $grid->column('customer_id','所属客户');

            $grid->column('crm_customer_id','所属客户')->display(function($Id) {
                return optional(CrmCustomer::find($Id))->name;
            });
            $grid->column('signdate','签订日期');
            $grid->rowSelector()->titleColumn('title');

            $grid->quickSearch(['id', 'title', 'crm_customer_id']);
            $grid->disableFilterButton();
            $grid->paginate(7);
            $grid->disableActions();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter)use($id) {
                $filter->like('id')->width(4)->default($id);
                $filter->like('title')->width(20);
                $filter->like('crm_customer_id')->width(4);
            });
        });
    }
}
