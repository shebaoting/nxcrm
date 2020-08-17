<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Admin;

class HomeController extends Controller
{

    public static $css = [
        '/static/css/home.css',
    ];

    public function index(Content $content)
    {
        Admin::css(static::$css);
        return $content
            ->header('NXCRM')
            ->description('控制台...')
            ->body(function (Row $row) {
                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(3, new Examples\Customers());
                        $row->column(3, new Examples\Leads());
                        $row->column(3, new Examples\Contracts());
                        $row->column(3, new Examples\Opportunitys());
                    });
                });
                $row->column(5, function (Column $column) {
                    $column->row(new Examples\Opportunitys_all());
                });

                $row->column(7, function (Column $column) {
                    $column->row(new Examples\Receipts());
                });

                $row->column(12, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(4, new Examples\Topuser());
                        $row->column(4, new Examples\LeadsRecent());

                        $row->column(4, function (Column $column) {
                            $column->row(function (Row $row) {
                                $row->column(12, new Examples\Adver());
                            });
                        });


                    });
                });


            });
    }
}
