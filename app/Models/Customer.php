<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	use HasDateTimeFormatter;

	public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function admin_users()
    {
        return $this->belongsTo(Admin_user::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function opportunitys()
    {
        return $this->hasMany(Opportunity::class);
    }
}
