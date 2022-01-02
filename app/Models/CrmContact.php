<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Notifications\Notifiable;
use Overtrue\EasySms\PhoneNumber;
use Illuminate\Database\Eloquent\Model;

class CrmContact extends Model
{
	use HasDateTimeFormatter,Notifiable;
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = [
        'name', 'phone'
    ];

    public function routeNotificationForEasySms($notification)
    {
        return new PhoneNumber($this->phone, 86);
    }

    public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

}
