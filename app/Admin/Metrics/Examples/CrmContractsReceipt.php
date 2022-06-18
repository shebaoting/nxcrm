<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Dcat\Admin\Admin;
use App\Models\CrmContract;
use Illuminate\Support\Facades\DB;

class CrmContractsReceipt extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */

    protected function init()
    {
        parent::init();
        $this->height(512);
        // 设置标题
        $this->title('待收款合同');
        $contracts = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->with('CrmCustomer')->whereRaw('receipt<total')->limit(6)->get();
        $this->withContent(view('admin.metrics.examples.contracts_receipt',compact('contracts')));
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
