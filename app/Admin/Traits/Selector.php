<?php

namespace App\Admin\Traits;


use Illuminate\Support\Facades\DB;

trait Selector
{

    protected function queryCustomer($day)
    {
        // 跟进表中所有的客户
        $EventsCustomer = array_column(DB::table('events')->select('customer_id')->groupBy('customer_id')->get()->toArray(), 'customer_id');
        //EventsCustomer2 = Event::all()->groupBy('customer_id')->toArray();
        // dd($EventsCustomer2);
        if (strpos(__CLASS__, 'Customer') !== false) {
            // 所有的客户
            $Info = array_column(DB::table('customers')->select('id')->where('state', '=', 3)->get()->toArray(), 'id');
        } elseif (strpos(__CLASS__, 'Lead') !== false) {
            // 所有的线索客户
            $Info = array_column(DB::table('customers')->select('id')->where('state', '!=', 3)->get()->toArray(), 'id');
        } else {
        }

        // N天未跟进的客户 （所有客户减去N天内跟进过的客户）
        $noEventsCustomer = DB::table('events')
            ->whereDate('created_at', '>=', date('Y-m-d', strtotime("-" . $day . " day")))
            ->groupBy('customer_id')
            ->get()
            ->toArray();
        $EventsCustomerid = array_column($noEventsCustomer, 'customer_id');
        $noEventsCustomerid = array_diff($Info, $EventsCustomerid);


        // 完全没有发布跟进的客户
        $noevent = array_diff($Info, $EventsCustomer);

        // N天未跟进客户 + 完全未发布跟进的客户
        return array_merge($noEventsCustomerid, $noevent);
    }


    protected function queryOpportunity($day)
    {
        // N天未跟进的商机
        $noEventsOpportunity = DB::table('events')
            ->whereDate('created_at', '<=', date('Y-m-d', strtotime("-" . $day . " day")))
            ->groupBy('opportunity_id')
            ->get()
            ->toArray();
        $noEventsOpportunityid = array_column($noEventsOpportunity, 'opportunity_id');

        // 跟进表中所有的商机
        $opportunity = array_column(DB::table('events')->select('opportunity_id')->groupBy('opportunity_id')->get()->toArray(), 'opportunity_id');

        // 所有的商机
        $Info = array_column(DB::table('opportunitys')->select('id')->get()->toArray(), 'id');
        // 完全没有发布跟进的商机
        $noevent = array_diff($Info, $opportunity);

        // N天未跟进商机 + 完全未发布跟进的商机
        return array_merge($noEventsOpportunityid, $noevent);
    }
}
