<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasDateTimeFormatter;

	public function customer()
    {
        return $this->belongsTo(customer::class);
    }

    public function admin_users()
    {
        return $this->belongsTo(Admin_user::class);
    }
}
