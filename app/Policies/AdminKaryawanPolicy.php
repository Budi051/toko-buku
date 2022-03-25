<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AdminKaryawanPolicy
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
    public function bukanmember(User $user)
    {
        return ($user->role == 'member' ? Response::deny("Anda bukan karyawan atau admin") : Response::allow());
    }
}
