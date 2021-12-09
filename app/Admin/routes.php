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
    //更改客户所属销售
    $router->patch('/customers/{customer}/changeUser', 'CustomerController@changeUser')->name('customers.changeUser')->where(['customers' => '[0-9]+']);
    //联系人
    $router->resource('contacts', 'ContactController');

    //跟进记录
    $router->resource('events', 'EventController');

    //合同
    $router->get('/contracts/{id}/nodes', 'ContractController@nodes')->name('contracts.nodes')->where(['article' => '[0-9]+']);
    $router->resource('contracts', 'ContractController');

    //收款
    $router->get('receipts/deposit','ReceiptController@deposit')
        ->name('receipts.deposit');
    $router->resource('receipts', 'ReceiptController');

    //附件
    $router->resource('attachments', 'AttachmentController');

    //线索
    $router->resource('leads', 'LeadController');

    //线索
    $router->resource('opportunitys', 'OpportunityController');

    //发票
    $router->patch('/invoices/{invoice}/state', 'InvoiceController@state')->name('invoices.state')->where(['article' => '[0-9]+']);
    $router->resource('invoices', 'InvoiceController');

    //产品
    $router->resource('products', 'ProductController');
    Route::get('/productslist', 'ProductController@list')->name('products.list');

    //字段
    $router->resource('customfields', 'CustomfieldController');

    //订单
    Route::get('/orders', 'OrderController@index')->name('order.index');

    //分享
    Route::post('/shares/store', 'ShareController@shareStore')->name('shares.store');

    //网站配置
    Route::get('/settings/{classinfo}', 'SettingsController@index')->name('settings.index');

    //导入
    Route::get('/import/form', 'ImportController@index');
    Route::post('/import/form', 'ImportController@store');

    //通讯录
    Route::get('/teams', 'TeamController@index')->name('Team.index');

    //合同范本
    $router->resource('modelcontracts', 'ModelcontractController');

    //生成合同
    Route::get('/buildContracts/form', 'BuildContractsController@index')->name('buildContracts.index');
    Route::post('/buildContracts/form', 'BuildContractsController@store');

    //业绩目标
    $router->resource('programs', 'ProgramController');

    //重写部门角色
    $router->resource('auth/roles', 'RoleController');

    //公海池
    $router->resource('customerpool', 'CustomerpoolController');
});
