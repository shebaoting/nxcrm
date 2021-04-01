<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;
use Dcat\Admin\Admin;
use App\Models\CrmReceipt;
use App\Models\CrmContract;

class CrmMyReceipts extends Line
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('合同与收款');
        $this->height(380);
        $this->chartHeight(330);
        $this->chartOption('chart.sparkline.enabled', false);
        $this->chartOption('legend.position', 'top');
        $color = Admin::color();
        $this->chartColors([$color->primary(), '#dbd9ed']);
        $this->chartOption('stroke.width', [2.5, 2.5]);
        $this->chartOption('stroke.dashArray', [0, 5]);

        $months_period = \Carbon\Carbon::parse(date('y-m-d', strtotime("-12 month")))->monthsUntil(date('y-m-d'));

        $receiptNum = CrmReceipt::whereHas('CrmContract.CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->selectRaw('DATE_FORMAT(updated_at,"%Y-%m") as date,SUM(receive) as value')->whereBetween('updated_at', [
            $months_period->first()->toDateString(),
            $months_period->last()->addMonths()->toDateString(),
        ])->groupBy('date')->pluck('value', 'date')->toArray();

        $receiptNum_tmp = iterator_to_array(
            $months_period->map(function ($month) use ($receiptNum) {
                $month_str = date('Y-m', strtotime($month));
                return [
                    'date' => $month_str,
                    'value' => $receiptNum[$month_str] ?? 0,
                ];
            })
        );

        $this->receiptNum = array_column($receiptNum_tmp,'value');
        $this->categories = array_column($receiptNum_tmp,'date');
        $contractNum = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->selectRaw('DATE_FORMAT(signdate,"%Y-%m") as date,SUM(total) as value')->whereBetween('signdate', [
            $months_period->first()->toDateString(),
            $months_period->last()->addMonths()->toDateString(),
        ])->groupBy('date')->pluck('value', 'date')->toArray();


        $contractNum_tmp = iterator_to_array(
            $months_period->map(function ($month) use ($contractNum) {
                $month_str = date('Y-m', strtotime($month));
                return [
                    'date' => $month_str,
                    'value' => $contractNum[$month_str] ?? 0,
                ];
            })
        );

        $this->contractNum = array_column($contractNum_tmp,'value');
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        // dd($contractNum);
        $this->withChart($this->contractNum, $this->receiptNum);
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data1, array $data2)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => '合同额',
                    'data' => $data1,
                ],
                [
                    'name' => '收款',
                    'data' => $data2,
                ],
            ],
            'xaxis' => [
                'categories' => $this->categories
            ],
        ]);
    }
}
