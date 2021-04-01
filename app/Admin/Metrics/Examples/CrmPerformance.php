<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Contracts\Support\Renderable;
use Dcat\Admin\Admin;
use App\Models\CrmProgram;
use App\Models\CrmContract;
use App\Models\CrmCustomer;
use App\Models\CrmOpportunity;
use App\Models\CrmReceipt;

class CrmPerformance extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    // 保存自定义参数
    protected $data = [];

    // 构造方法参数必须设置默认值
    public function __construct(array $data = [])
    {
        $this->data = [];

        parent::__construct();
    }

    protected function init()
    {
        parent::init();

        // 设置标题
        $this->title('今日任务进度');
        $this->header('我的每日业绩目标完成进度...');
        // 设置下拉菜单
        $programs = json_decode((CrmProgram::where('admin_user_id', '=', Admin::user()->id)->first())['daily'], true);

        // 每日新增合同数
        $add_contract = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereDate('signdate', date('y-m-d'))->count();

        // 每日新增客户
        $add_customer = CrmCustomer::where('admin_user_id', Admin::user()->id)->whereDate('created_at', date('y-m-d'))->count();

        // 每日新增商机
        $add_opportunity = CrmOpportunity::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereDate('created_at', date('y-m-d'))->count();

        // 每日新增收款
        $add_receipt_sum = CrmReceipt::whereHas('CrmContract.CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereDate('created_at', date('y-m-d'))->sum('receive');

        // 每月新增商机金额
        $add_opportunity_sum =  CrmOpportunity::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereDate('created_at', date('y-m-d'))->sum('expectincome');

        // 每日新增合同金额
        $add_contract_sum  =  CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereDate('signdate', date('y-m-d'))->sum('total');
        // dd($add_receipt_sum);

        $dailydata = collect(['add_contract' => $add_contract, 'add_customer' => $add_customer, 'add_opportunity' => $add_opportunity, 'add_receipt_sum' => $add_receipt_sum, 'add_opportunity_sum' => $add_opportunity_sum, 'add_contract_sum' => $add_contract_sum]);


        $this->withContent(view('admin.metrics.examples.performance', compact('programs','dailydata')));
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
            {$content}</h1>
HTML
        );
    }
}
