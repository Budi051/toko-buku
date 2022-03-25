<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class KaryawanPolicy
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
    public function checkkaryawan(User $user)
    {
        return ($user->role == 'karyawan' ? Response::allow() : Response::deny("Anda bukan karyawan"));
    }
}
