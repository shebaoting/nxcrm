<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'opportunitys';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
