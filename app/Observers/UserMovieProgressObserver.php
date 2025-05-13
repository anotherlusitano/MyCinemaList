<?php

namespace App\Observers;

use App\Models\UserMovieProgress;

class UserMovieProgressObserver
{
    /**
     * Handle the UserMovieProgress "created" event.
     */
    public function created(UserMovieProgress $userMovieProgress): void
    {
//        if ($userMovieProgress->watch_status === 'completed') {
//            $userMovieProgress->completed_watching_date = $userMovieProgress->completed_watching_date ?? now();
//        } else {
//            $userMovieProgress->completed_watching_date = null;
//        }
    }

    /**
     * Handle the UserMovieProgress "updated" event.
     */
    public function updated(UserMovieProgress $userMovieProgress): void
    {
        if ($userMovieProgress->watch_status === 'completed') {
            $userMovieProgress->completed_watching_date = $userMovieProgress->completed_watching_date ?? now();
        } else {
            $userMovieProgress->completed_watching_date = null;
        }
    }

    /**
     * Handle the UserMovieProgress "deleted" event.
     */
    public function deleted(UserMovieProgress $userMovieProgress): void
    {
        //
    }

    /**
     * Handle the UserMovieProgress "restored" event.
     */
    public function restored(UserMovieProgress $userMovieProgress): void
    {
        //
    }

    /**
     * Handle the UserMovieProgress "force deleted" event.
     */
    public function forceDeleted(UserMovieProgress $userMovieProgress): void
    {
        //
    }
}
