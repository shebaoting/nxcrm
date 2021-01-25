<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmOrder extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_orders';
    protected $fillable = [
        'crm_product_id',
        'executionprice',
        'quantity',
    ];
    public $timestamps = false;

    public function CrmContract()
    {
        return $this->belongsTo(CrmContract::class);
    }

    public function CrmProduct()
    {
        return $this->belongsTo(CrmProduct::class);
    }
}
