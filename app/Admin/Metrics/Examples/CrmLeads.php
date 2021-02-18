<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CrmLeads extends Line
{
    /**
     * 初始化卡片内容
     *
     * @return void
     */
    protected function init()
    {
        parent::init();

        $this->title('潜在顾客');


        $leads = DB::table('crm_customers')->where('state', '<>', 3);
        $this->leads_num = $leads->count();
        $this->num = $leads->selectRaw('DATE_FORMAT(created_at,"%Y-%m") as date,COUNT(*) as value')->groupBy('date')->get();
        // dd($this->num->count());
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
                $this->withContent($this->leads_num);
                // 图表数据
                if ($this->num->count()) {
                    $this->withChart(array_column($this->num->toArray(), 'value'));
                } else {
                    $this->withChart([0]);
                }

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
     * 设置卡片内容.
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
<div class="d-flex justify-content-between align-items-center" style="margin-bottom: 2px; padding-left: 1.875rem;">
    <h2 class="font-lg-1">{$content}</h2>
    <span class="mb-0 mr-1 text-80">{$this->title}</span>
</div>
HTML
        );
    }
}
