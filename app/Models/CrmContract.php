<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use App\Admin\Traits\ContractTime;

class CrmContract extends Model
{
	use HasDateTimeFormatter,ContractTime;
    public $timestamps = false;
    protected $fillable = ['nodes'];
    public function CrmReceipts()
    {
        return $this->hasMany(CrmReceipt::class);
    }

    public function CrmOrders()
    {
        return $this->hasMany(CrmOrder::class);
    }

    public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function CrmEvents()
    {
        return $this->hasMany(CrmEvent::class);
    }

    public function CrmInvoices()
    {
        return $this->hasMany(CrmInvoice::class);
    }

    /**
     * 获取实时支出
     */
    public function getCalcSalesExpensesAttribute()
    {
        $calcSalesExpenses= 0;
        foreach($this->CrmReceipts as $receipt)
        {
            if ($receipt->type === 2){
                $calcSalesExpenses+=$receipt->receive;
            }
        }
        return $calcSalesExpenses;
    }

        /**
     * 获取实时收款
     */
    public function getCalcSalesRevenueAttribute()
    {
        $calcSalesRevenue= 0;
        foreach($this->CrmReceipts as $receipt)
        {
            if ($receipt->type === 1){
                $calcSalesRevenue+=$receipt->receive;
            }
        }
        return $calcSalesRevenue;
    }

}
