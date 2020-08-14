<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	use HasDateTimeFormatter;    
    public $timestamps = false;
    protected $fillable = [
        'name', 'phone'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
