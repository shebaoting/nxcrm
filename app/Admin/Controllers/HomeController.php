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
        Admin::style(
            <<<CSS
.content-header .breadcrumb {
    display:block;
}
.content-header .breadcrumb li:first-child {
    display:none
}
.breadcrumb-item+.breadcrumb-item:before {
    display: none;
}
CSS
        );

        return $content
            ->header('控制台')
            ->description('控制台...')
            ->breadcrumb(Examples\CrmProgram::build())
            ->body(function (Row $row) {
                $row->column(8, function (Column $column) {
                    $column->row(Examples\CrmMyinfo::title());
                    $column->row(Examples\CrmMyinfo::Shortcuts());
                    $column->row(function (Row $row) {
                        $row->column(4, new Examples\CrmMyCustomers());
                        $row->column(4, new Examples\CrmMyLeads());
                        $row->column(4, new Examples\CrmMyContracts());
                        // $row->column(3, new Examples\CrmMyOpportunitys());
                    });
                    $column->row(new Examples\CrmMyReceipts());
                    $column->row(function (Row $row) {
                        // $row->column(4, new Examples\CrmLeadsRecent());
                        $row->column(6, new Examples\CrmContractsReceipt());
                        $row->column(6, new Examples\CrmContractsCompliance());
                    });
                });

                $row->column(4, function (Column $column) {
                    $column->row(new Examples\CrmTopuser());
                    $column->row(new Examples\CrmMyContractTotal());
                    $column->row(new Examples\CrmPerformance());
                    $column->row(Examples\CrmAdver::Adver());
                });


            });
    }
}

// 发布收款时，需要同时增加合同的收款额
