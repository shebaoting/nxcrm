<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Admin;

class HomeController extends Controller
{

    public static $css = [
        '/static/css/home.css',
    ];
    public function script()
    {
        return <<<JS
    (function(a, b, c, d, e, j, s) {
        a[d] = a[d] || function() {
            (a[d].a = a[d].a || []).push(arguments)
        };
        j = b.createElement(c),
            s = b.getElementsByTagName(c)[0];
        j.async = true;
        j.charset = 'UTF-8';
        j.src = 'https://static.meiqia.com/widget/loader.js';
        s.parentNode.insertBefore(j, s);
    })(window, document, 'script', '_MEIQIA');
    _MEIQIA('entId', 152228);
JS;
    }
    public function index(Content $content)
    {
        Admin::css(static::$css);
        // if (Admin::user()->isAdministrator()){
        //     Admin::script($this->script());
        // }

        return $content
            ->header('控制台')
            ->description('控制台...')
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(3, new Examples\CrmCustomers());
                        $row->column(3, new Examples\CrmLeads());
                        $row->column(3, new Examples\CrmContracts());
                        $row->column(3, new Examples\CrmOpportunitys());
                    });
                });
                $row->column(5, function (Column $column) {
                    $column->row(new Examples\CrmOpportunitysAll());
                });

                $row->column(7, function (Column $column) {
                    $column->row(new Examples\CrmReceipts());
                });

                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(4, new Examples\CrmTopuser());
                        $row->column(4, new Examples\CrmLeadsRecent());

                        $row->column(4, function (Column $column) {
                            $column->row(function (Row $row) {
                                $row->column(12, new Examples\CrmAdver());
                            });
                        });
                    });
                });
            });
    }
}
