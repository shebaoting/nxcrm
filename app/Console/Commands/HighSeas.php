<?php

namespace App\Console\Commands;

use App\Models\CrmCustomer;
use Illuminate\Console\Command;

class HighSeas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxos:high-seas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将符合条件的客户放入公海';

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
    public function handle(CrmCustomer $Customer)
    {
        // 在命令行打印一行信息
        $this->info("开始计算...");

        $Customer->accessHighSeas();

        $this->info("成功生成！");
    }
}
