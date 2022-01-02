<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Widgets\Tab;
use App\Admin\Forms\Setting;
use App\Admin\Forms\Highseas;
use App\Admin\Forms\Reminder;
use App\Admin\Forms\Company;
use App\Admin\Forms\Sms;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(Content $content, $classinfo)
    {
        $tab = Tab::make();
        switch ($classinfo) {
            case 'setting':
                $tab->add('站点设置', new Setting());
                $tab->add('短信配置', new Sms());

                return $content
                    ->title('网站设置')
                    ->description('详情')
                    ->body($tab->withCard());
                break;
            case 'highseas':
                return $content
                    ->title('公海设置')
                    ->description('详情')
                    ->body(Card::make('设置', new Highseas())->withHeaderBorder());
                break;
            case 'company':
                return $content
                ->title('公司信息')
                ->description('详情')
                ->body(Card::make('设置', new Company())->withHeaderBorder());
                break;
            case 'reminder':
                return $content
                ->title('消息通知')
                ->description('详情')
                ->body(Card::make('合同到期通知', new Reminder())->withHeaderBorder());
                break;
            default:
                $title = '运营设置';
        }
    }
}
