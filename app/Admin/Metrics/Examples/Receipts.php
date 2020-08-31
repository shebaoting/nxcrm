<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Receipts extends Line
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('收入');
        $this->height(450);
        $this->chartHeight(230);


        $this->num = DB::table('receipts')->selectRaw('DATE_FORMAT(updated_at,"%Y-%m") as date,SUM(receive) as value')->groupBy('date')->orderBy('date')->limit(12)->get();

        $this->origin = DB::table('receipts')->selectRaw('DATE_FORMAT(updated_at,"%Y-%m") as date,SUM(receive) as value')
        ->whereMonth('updated_at', date('m'))
        ->groupBy('date')
        ->get();

        $this->last_month = DB::table('receipts')->selectRaw('DATE_FORMAT(updated_at,"%Y-%m") as date,SUM(receive) as value')
        ->whereMonth('updated_at', date('m',strtotime("-1 month")))
        ->groupBy('date')
        ->get();

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

                // 卡片内容
                $this->withContent($this->origin[0]->value, $this->last_month[0]->value);

                // 图表数据
                $this->withChart(array_column($this->num->toArray(), 'value'));
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => [
                [
                    'name' => $this->title,
                    'data' => $data,
                ],
            ],
        ]);
    }

    /**
     * 卡片内容.
     *
     * @param int $finished
     * @param int $pending
     * @param int $rejected
     *
     * @return $this
     */
    public function withContent($CurrentMonth, $PreviousMonth)
    {
        return $this->content(
            <<<HTML
<div class="row text-center" style="margin: 20px 0px; padding: 1.5rem;">
    <div class="col-md-6">
        <p>本月</p>
        <span class="font-lg-1">{$CurrentMonth}元</span>
    </div>
    <div class="col-md-6">
        <p>上个月</p>
        <span class="font-lg-1">{$PreviousMonth}元</span>
    </div>
</div>
HTML
        );
    }
}
