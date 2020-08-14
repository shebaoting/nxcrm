<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 客户
    $router->resource('customers', 'CustomerController');

    //联系人
    $router->resource('contacts', 'ContactController');

    //跟进记录
    $router->resource('events', 'EventController');

    //合同
    $router->resource('contracts', 'ContractController');

    //收款
    $router->resource('receipts', 'ReceiptController');

    //附件
    $router->resource('attachments', 'AttachmentController');

    //线索
    $router->resource('leads', 'LeadController');

    //线索
    $router->resource('opportunitys', 'OpportunityController');

    // 网站配置;
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
});
