<?php

use Dcat\Admin\Admin;
use App\Models\Admin_user;
use Dcat\Admin\Grid;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Layout\Navbar;

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

// dd(admin_setting('style_type', 1));
Admin::baseCss(['static/css/nxcrm'.admin_setting('style_type', 2).'.css'], true);
Admin::asset()->alias('@nunito', null, '');
Admin::asset()->alias('@montserrat', null, '');

Dcat\Admin\Color::extend('green', [
    'primary'        => '#17b95c',
    'primary-darker' => '#17b95c',
    'link'           => '#17b95c',
]);

if(admin_setting('style_type') == 1){
    Grid::resolving(function (Grid $grid) {
        $grid->tableCollapse(false);
    });
}

admin_inject_section('isadmin', function () {
    $setting_menu = [
        'admin/settings/setting',
        'admin/settings/highseas',
        'admin/settings/companys',
        'admin/auth/users',
        'admin/auth/roles',
        'admin/products',
        'admin/customfields',
        'admin/modelcontracts'
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
            if (in_array($item['title'], ['Admin','operations','contents'])) {
                $html .= view('admin.partials.menu', ['item' => $item, 'builder' => $builder])->render();
            }
        }else {
            if (!in_array($item['title'], ['Admin','operations','contents'])) {
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
$logo = '<img src="'.$site_url.'storage/'.admin_setting('logo').'"> &nbsp;'.admin_setting('crmname');

$logo_mini = '<img src="'.$site_url.'storage/'.admin_setting('logo').'">';
config([
    'app.url' => admin_setting('crmurl'),
    'admin.title' => admin_setting('crmname'),
    'admin.name' => admin_setting('crmname'),
    'admin.logo' => $logo,
    'admin.logo-mini' => $logo_mini,
    'admin.layout.body_class' => 'default',
    'admin.layout.sidebar_style' => admin_setting('sidebar_style'),
    'admin.layout.dark_mode_switch' => true,
    'admin.layout.color' => 'green',
    'admin.layout.horizontal_menu' => admin_setting('horizontal_menu'),
]);

if(Admin::user()){
Admin::navbar(function (Navbar $navbar) {
       // 下拉面板
       $notifications = Admin_user::findOrFail(Admin::user()->id)->unreadNotifications;
       $count = $notifications->count();
       $navbar->right(view('admin.public.message',compact('notifications', 'count')));
});
}
