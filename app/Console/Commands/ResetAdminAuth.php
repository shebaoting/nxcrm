<?php

namespace App\Console\Commands;

use App\Models\Admin_user;
use Illuminate\Console\Command;

class ResetAdminAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nxcrm:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重置Admin账户';

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
        $user = Admin_user::where('username', 'admin')->first();
        if (empty($user)) {
            $user = new Admin_user();
            $user->username = 'admin';
        }
        $user->password = bcrypt('admin');
        $user->name = 'Administrator';
        $user->save();
        $this->info('Admin账户已成功重置为 admin/admin');
        return 0;
    }
}
