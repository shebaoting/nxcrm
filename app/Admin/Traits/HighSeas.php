<?php

namespace App\Admin\Traits;
use Illuminate\Support\Facades\DB;
trait HighSeas
{
    public function accessHighSeas()
    {

        // 跟进表中所有的客户
        $EventsCustomer = array_column(DB::table('crm_events')->select('crm_customer_id')->groupBy('crm_customer_id')->get()->toArray(), 'crm_customer_id');

        // 所有的线索客户
        $leadsInfo = array_column(DB::table('crm_customers')->select('id')->where([['state', '!=', 3], ['admin_user_id', '!=', 0]])->get()->toArray(), 'id');

        // 所有的正常客户
        $customersInfo = array_column(DB::table('crm_customers')->select('id')->where([['state', '=', 3], ['admin_user_id', '!=', 0]])->get()->toArray(), 'id');


        // N天未跟进的线索
        $noEventsLeads = DB::table('crm_events')
        ->whereDate('created_at', '>=', date('Y-m-d', strtotime("-" . admin_setting('leadshighseas', 30) . " day")))
        ->groupBy('crm_customer_id')
        ->get()
        ->toArray();
        $EventsCustomerid = array_column($noEventsLeads, 'crm_customer_id');
        $noEventsLeadsid = array_diff($leadsInfo, $EventsCustomerid);

        // N天未跟进的客户
        $noEventsCustomer = DB::table('crm_events')
        ->whereDate('created_at', '>=', date('Y-m-d', strtotime("-" . admin_setting('customershighseas', 180) . " day")))
        ->groupBy('crm_customer_id')
        ->get()
        ->toArray();
        $EventsCustomerid = array_column($noEventsCustomer, 'crm_customer_id');
        $noEventsCustomersId = array_diff($customersInfo, $EventsCustomerid);

        // 完全没有发布跟进的客户
        // $noevent = array_diff($leadsInfo, $EventsCustomer);

        // 创建时间大于N天的未跟进的线索
        $noEventsdate = DB::table('crm_customers')->whereIn('id', $noEventsLeadsid)
        ->whereDate('created_at', '<=', date('Y-m-d', strtotime("-" . admin_setting('leadshighseas', 30) . " day")))->groupBy('id')
        ->get()
        ->toArray();
        $resultsLeads = array_column($noEventsdate, 'id');


        // 创建时间大于N天的未跟进的客户
        $noEventsdate = DB::table('crm_customers')->whereIn('id', $noEventsCustomersId)
        ->whereDate('created_at', '<=', date('Y-m-d', strtotime("-" . admin_setting('customershighseas', 180) . " day")))->groupBy('id')
        ->get()
        ->toArray();
        $resultsCustomers = array_column($noEventsdate, 'id');

        $results= array_merge($resultsLeads,$resultsCustomers);
        // 客户筛选，执行放入公海操作
        $HighSeasCustomer = self::whereIn('id', $results)
        ->update(['admin_user_id' => 0]);
        return;
    }
}
