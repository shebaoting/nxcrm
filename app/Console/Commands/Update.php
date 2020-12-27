<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Update extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxcrm:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '对Nxcrm进行升级操作';

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
        $this->call('migrate');
        $this->info('数据库迁移完成！');
        $this->call('db:seed', ['--class' => 'AdminTablesSeeder']);
        $this->info('菜单数据重置完成！');
        $this->call('view:clear');
        $this->info('模版缓存清理完成！');
        $this->info('升级完成！');
        return 0;
    }
}
