<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasDateTimeFormatter;

	public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function admin_user()
    {
        return $this->belongsTo(Admin_user::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
