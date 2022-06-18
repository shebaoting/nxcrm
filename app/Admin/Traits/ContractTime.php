<?php

namespace App\Admin\Traits;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\CrmContract;
use App\Notifications\ContractTime as ContractTimeNotification;
use App\Notifications\ContractTimeToContact;

trait ContractTime
{
    public function contractExp()
    {
        if(admin_setting_array('reminder')['contract_day'] == 'weekly'){
            $day = 7;
        }elseif (admin_setting_array('reminder')['contract_day'] == 'monthly') {
            $day = 31;
        }
        $contracts = DB::table('crm_contracts')
        ->whereBetween('expiretime', [today(),Carbon::now()->addDays(+$day)])
        ->groupBy('crm_customer_id')
        ->get();
        return $contracts;
    }

    public function contractExpNoticeToAdmin()
    {
        foreach ($this->contractExp() as $contract) {
            $contract_show = CrmContract::findOrFail($contract->id);
            $adminUser = $contract_show->CrmCustomer->adminUser;
            $adminUser->notify(new ContractTimeNotification($contract_show));
        }
        return;
    }

    public function contractExpNoticeToUser()
    {
        foreach ($this->contractExp() as $contract) {
            $contract_show = CrmContract::findOrFail($contract->id);
            $users = $contract_show->CrmCustomer->CrmContacts;
            foreach ($users as $user) {
                $user->notify(new ContractTimeToContact($user,$contract_show->expiretime));
            }

        }
        return;
    }
}
