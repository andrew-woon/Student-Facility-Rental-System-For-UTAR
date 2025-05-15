<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }
    
    public function view(User $user, Schedule $schedule)
    {
        return $user->role === 'admin' || $user->id === $schedule->user_id;
    }
    
    public function create(User $user)
    {
        return $user->role === 'user';
    }

    public function update(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id && $schedule->status === 'pending';
    }

    public function delete(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id && $schedule->status === 'pending';
    }

    public function approveReject(User $user)
    {
        return $user->role === 'admin';
    }
}

