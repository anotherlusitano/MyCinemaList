<?php

namespace App\Livewire;

use App\Models\UserMovieProgress;
use Carbon\Carbon;
use Livewire\Component;

class UserMovieProgressDropdown extends Component
{
    public $userMovieProgressId;
    protected $completed_watching_date;
    public $watch_status;
    public $score;

    public function mount($userMovieProgressId)
    {
        $progress = UserMovieProgress::query()->findOrFail($userMovieProgressId);

        $this->watch_status = $progress->watch_status;
        $this->score = $progress->score;
        $this->completed_watching_date = $progress->completed_watching_date;
    }

    public function save($field, $value)
    {
        $progress = UserMovieProgress::query()->findOrFail($this->userMovieProgressId);

        if ($field === 'watch_status') {
            $date = $value === 'completed' ? Carbon::now() : null;

            $progress->watch_status = $value;
            $progress->completed_watching_date = $date;

            // update state
            $this->watch_status = $value;
            $this->completed_watching_date = $date;
        }

        if ($field === 'score') {
            // If the score is null, it won't be included in the star rating calculation
            $progress->score = $value !== '' ? (int)$value : null;
            $this->score = $value; // update local state
        }

        $progress->save();
    }

    public function render()
    {
        return view('livewire.user-movie-progress-dropdown');
    }
}
