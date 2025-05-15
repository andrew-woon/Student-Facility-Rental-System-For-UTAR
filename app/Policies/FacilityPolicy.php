<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Facility;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacilityPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Facility $facility)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Facility $facility)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Facility $facility)
    {
        return $user->role === 'admin';
    }
}

