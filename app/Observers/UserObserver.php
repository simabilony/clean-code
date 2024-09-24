<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Carbon;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
    public function creating(User $user)
    {
        $user->start_at = Carbon::createFromFormat('m/d/Y', $user->start_at)->format('Y-m-d');
        $user->password = bcrypt($user->password);
    }
}
