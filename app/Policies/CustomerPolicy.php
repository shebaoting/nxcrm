<?php

namespace App\Policies;

use Dcat\Admin\Models\Administrator;
use App\models\Customer;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(Administrator $currentUser, Customer $Customer)
    {
        // return $currentUser->id === $Customer->admin_users_id
        //     ? Response::allow()
        //     : Response::deny('You do not own this post.');
        return true;
    }
}
