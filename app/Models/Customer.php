<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Traits\HighSeas;

class Customer extends Model
{
	use HasDateTimeFormatter,HighSeas;

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

    public function shares_user()
    {
        return $this->belongsToMany(Admin_user::class, 'shares', 'customer_id', 'user_id');
    }
}
