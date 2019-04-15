<?php

namespace App\Policies;

use App\User;
use App\Certificate;

use Illuminate\Auth\Access\HandlesAuthorization;

class CertificatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the Certificate.
     *
     * @param  \App\User  $user
     * @param  \App\Certificate  $certificate
     * @return mixed
     */
    public function view(User $user, Certificate $certificate)
    {
        //
        return $user->id === $certificate->user->id;
    }

    /**
     * Determine whether the user can create Certificates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the Certificate.
     *
     * @param  \App\User  $user
     * @param  \App\Certificate  $certificate
     * @return mixed
     */
    public function update(User $user, Certificate $certificate)
    {
        //
        return $user->id === $certificate->user->id;
    }

    /**
     * Determine whether the user can delete the Certificate.
     *
     * @param  \App\User  $user
     * @param  \App\Certificate  $certificate
     * @return mixed
     */
    public function delete(User $user, Certificate $certificate)
    {
        //
        return $user->id === $certificate->user->id;
    }
}
