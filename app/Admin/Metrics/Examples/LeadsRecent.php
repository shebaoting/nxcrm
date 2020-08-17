<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class LeadsRecent extends Card
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
        $leads = Customer::with('admin_users')->where('state', '<>', 3)->get();
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
