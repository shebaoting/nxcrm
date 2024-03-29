<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Models\CrmCustomer;
use Illuminate\Support\Facades\DB;

class CrmLeadsRecent extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */

    protected function init()
    {
        parent::init();
        $this->height(450);
        // 设置标题
        $this->title('最近的线索');
        $leads = CrmCustomer::with('adminUser')->where([['state', '=', 1], ['admin_user_id', '!=', 0]])->limit(6)->get();
        $this->withContent(view('admin.metrics.examples.leads_recent',compact('leads')));
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
