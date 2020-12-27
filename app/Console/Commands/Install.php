<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxcrm:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '对Nxcrm进行初始化安装';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('正在优化配置！');
        $this->call('optimize:clear');
        $this->info('正在设置存储系统！');
        $this->call('storage:link');
        $this->info('正在配置APP密钥！');
        $this->call('key:generate');
//        $this->info('正在配置JWT密钥！');
//        $this->call('jwt:secret');
        $this->info('正在处理数据库迁移！');
        $this->call('migrate');
        $this->info('正在初始化数据！');
        $this->call('db:seed', ['--class' => 'AdminTablesSeeder']);
        $this->call('nxcrm:reset');
        $this->info('正在处理清理模版缓存！');
        $this->call('view:clear');
        $this->info('安装完成！');
        $this->warn('用户名密码都为：admin');
        return 0;
    }
}
