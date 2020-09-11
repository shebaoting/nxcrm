<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
	use HasDateTimeFormatter;
    public $timestamps = false;

    public function Receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function Events()
    {
        return $this->hasMany(Event::class);
    }

    public function Invoices()
    {
        return $this->hasManyThrough('App\Models\Invoice', 'App\Models\Receipt');
    }
}
