<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class AdminRoleUsers extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'admin_role_users';
}
