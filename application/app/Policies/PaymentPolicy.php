<?php

namespace App\Policies;

use App\Sitri\Models\Admin\Payment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
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

    public function list(User $auth)
    {
        return $auth->hasAccess('list-payment');
    }

    public function create(User $auth)
    {
        return $auth->hasAccess('create-payment');
    }

    public function update(User $auth, Payment $payment)
    {
        return $auth->hasAccess('update-payment') && ($payment->student->user === $auth || $auth->hasAccess('full-user'));
    }

    public function delete(User $auth, Payment $payment)
    {
        return $auth->hasAccess('delete-payment') && ($payment->student->user === $auth || $auth->hasAccess('full-user'));
    }
}
