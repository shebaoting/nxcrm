<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Models\Administrator;
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
        return $this->belongsTo(Administrator::class);
    }
}
