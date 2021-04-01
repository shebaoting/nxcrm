<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Admin_user as user;

class CrmTopUser extends Card
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
        $this->title('本月团队排行');
        $this->header('本月的合同签署量排行...');
        $users = user::with('CrmContracts')->select(['id', 'name','avatar'])
        ->withSum('CrmContracts', 'total')->whereHas('CrmContracts', function ($query) {
            $query->whereYear('signdate', date('Y'))->whereMonth('signdate', date('m'));
        })->orderBy('crm_contracts_sum_total', 'desc')->limit(5)->get();
// dd($users);

        $this->withContent(view('admin.metrics.examples.topuser',compact('users')));
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
