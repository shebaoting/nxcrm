<?php

namespace App\Policies;

use Dcat\Admin\Models\Administrator;
use App\models\CrmCustomer;
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

    public function update(Administrator $currentUser, CrmCustomer $Customer)
    {
        // return $currentUser->id === $Customer->admin_user_id
        //     ? Response::allow()
        //     : Response::deny('You do not own this post.');
        return true;
    }
}
