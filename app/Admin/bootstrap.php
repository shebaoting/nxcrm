<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Support\Helper;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */


Dcat\Admin\Color::extend('wechat', [
    'primary'        => '#07c160',
    'primary-darker' => '#06ad56',
    'link'           => '#07c160',
]);

Grid::resolving(function (Grid $grid) {
    $grid->tableCollapse(false);
});
Admin::baseCss(['static/css/nxcrm.css'], true);
Admin::asset()->alias('@nunito', null, '');
Admin::asset()->alias('@montserrat', null, '');

Dcat\Admin\Color::extend('douyin', [
    'primary'        => '#fe2d54',
    'primary-darker' => '#ff5770',
    'link'           => '#fe2d54',
]);



admin_inject_section('isadmin', function () {
    $setting_menu = [
        'admin/settings/setting',
        'admin/settings/highseas',
        'admin/auth/users',
        'admin/auth/roles',
        'admin/products',
        'admin/customfields'
    ];
    $route = request()->path();
    $isadmin = in_array($route, $setting_menu);
    return $isadmin;
}, false, 1);


admin_inject_section(Admin::SECTION['LEFT_SIDEBAR_MENU'], function () {
    $menuModel = config('admin.database.menu_model');
    $builder = Admin::menu();
    $html = '';
    $menu_date = Helper::buildNestedArray((new $menuModel())->allNodes());

    // dd(admin_section('isadmin', false));
    foreach ($menu_date as $item) {

        if (admin_section('isadmin', false)) {
            if (in_array($item['title'], ['Admin','operations'])) {
                $html .= view('admin.partials.menu', ['item' => $item, 'builder' => $builder])->render();
            }
        }else {
            if (!in_array($item['title'], ['Admin','operations'])) {
                $html .= view('admin.partials.menu', ['item' => $item, 'builder' => $builder])->render();
            }
        }
    }

    return $html;
});

admin_inject_section(Admin::SECTION['NAVBAR_USER_PANEL'], function () {
    return view('admin.partials.navbar-user-panel', ['user' => Admin::user()]);
});


//  复写站点配置
$site_url = admin_setting('crmurl');
$logo = '<img src="'.$site_url.'uploads/'.admin_setting('logo').'" width="35"> &nbsp;'.admin_setting('crmname');

$logo_mini = '<img src="'.$site_url.'uploads/'.admin_setting('logo').'">';

config([
    'app.url' => admin_setting('crmurl'),
    'admin.title' => admin_setting('crmname'),
    'admin.name' => admin_setting('crmname'),
    'admin.logo' => $logo,
    'admin.logo-mini' => $logo_mini,
    'admin.layout.body_class' => admin_setting('body_class'),
    'admin.layout.sidebar_style' => admin_setting('sidebar_style'),
    'admin.layout.dark_mode_switch' => admin_setting('sidebar_style'),
    'admin.layout.color' => admin_setting('color'),
]);


// dd(config('app.APP_DEBUG'));
