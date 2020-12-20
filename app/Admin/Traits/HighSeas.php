<?php

namespace App\Admin\Traits;
use Illuminate\Support\Facades\DB;
trait HighSeas
{
    public function accessHighSeas()
    {

        // 跟进表中所有的客户
        $EventsCustomer = array_column(DB::table('events')->select('customer_id')->groupBy('customer_id')->get()->toArray(), 'customer_id');

        // 所有的线索客户
        $leadsInfo = array_column(DB::table('customers')->select('id')->where([['state', '!=', 3], ['admin_users_id', '!=', 0]])->get()->toArray(), 'id');

        // 所有的正常客户
        $customersInfo = array_column(DB::table('customers')->select('id')->where([['state', '=', 3], ['admin_users_id', '!=', 0]])->get()->toArray(), 'id');


        // N天未跟进的线索
        $noEventsLeads = DB::table('events')
        ->whereDate('created_at', '>=', date('Y-m-d', strtotime("-" . admin_setting('leadshighseas', 30) . " day")))
        ->groupBy('customer_id')
        ->get()
        ->toArray();
        $EventsCustomerid = array_column($noEventsLeads, 'customer_id');
        $noEventsLeadsid = array_diff($leadsInfo, $EventsCustomerid);

        // N天未跟进的客户
        $noEventsCustomer = DB::table('events')
        ->whereDate('created_at', '>=', date('Y-m-d', strtotime("-" . admin_setting('customershighseas', 180) . " day")))
        ->groupBy('customer_id')
        ->get()
        ->toArray();
        $EventsCustomerid = array_column($noEventsCustomer, 'customer_id');
        $noEventsCustomersId = array_diff($customersInfo, $EventsCustomerid);

        // 完全没有发布跟进的客户
        // $noevent = array_diff($leadsInfo, $EventsCustomer);

        // 创建时间大于N天的未跟进的线索
        $noEventsdate = DB::table('customers')->whereIn('id', $noEventsLeadsid)
        ->whereDate('created_at', '<=', date('Y-m-d', strtotime("-" . admin_setting('leadshighseas', 30) . " day")))->groupBy('id')
        ->get()
        ->toArray();
        $resultsLeads = array_column($noEventsdate, 'id');


        // 创建时间大于N天的未跟进的客户
        $noEventsdate = DB::table('customers')->whereIn('id', $noEventsCustomersId)
        ->whereDate('created_at', '<=', date('Y-m-d', strtotime("-" . admin_setting('customershighseas', 180) . " day")))->groupBy('id')
        ->get()
        ->toArray();
        $resultsCustomers = array_column($noEventsdate, 'id');

        $results= array_merge($resultsLeads,$resultsCustomers);
        // 客户筛选，执行放入公海操作
        $HighSeasCustomer = self::whereIn('id', $results)
        ->update(['admin_users_id' => 0]);
        return;
    }
}


// 剩下需要做的是传参。后台配置传参到这里。
// 另外是把线索的公海时间和客户的公海时间分开。
