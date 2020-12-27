<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
     /**
     * 版本号.
     *
     * @var string
     */
    const VERSION = '1.12.27.5';

    public function index(Content $content, $classinfo)
    {
        switch ($classinfo){
            case 'setting':
            $title = '网站设置';
            break;
            case 'highseas':
            $title = '公海设置';
            break;
            default:
            $title = '运营设置';
            }

        $classinfo = '\App\Admin\Forms\\'.$classinfo;
        return $content
            ->title($title)
            ->description('详情')
            ->body(Card::make('设置', new $classinfo())->withHeaderBorder());
    }

}
