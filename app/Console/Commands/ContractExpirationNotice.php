<?php

namespace App\Console\Commands;

use App\Models\CrmContract;
use Illuminate\Console\Command;

class ContractExpirationNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxos:contract-exp-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '合同到期通知合同负责人';

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
    public function handle(CrmContract $contract)
    {
                // 在命令行打印一行信息
                if(count(json_decode(admin_setting_array('reminder')['contract_admin_method']))){
                $this->info("开始发送合同到期通知给销售人员...");
                $contract->contractExpNoticeToAdmin();
                $this->info("成功发送！");
                }
                if(count(json_decode(admin_setting_array('reminder')['contract_user_method']))){
                $this->info("开始发送合同到期通知给客户...");
                $contract->contractExpNoticeToUser();
                $this->info("成功发送！");
                 }
    }
}
