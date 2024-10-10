<?php

namespace App\Livewire\Cv;

use App\Models\User;
use Livewire\Component;

class ShowCv extends Component
{
    public $user;

    public function mount($username)
    {
        $this->user = User::with('userCv')->where('username', $username)->firstOrFail();

        if ($this->user->userCv) {
            if (is_string($this->user->userCv->projects)) {
                $projects = json_decode($this->user->userCv->projects, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return;
                }
            } else {
                $projects = $this->user->userCv->projects;
            }

            if (!is_array($projects)) {
                return;
            }

            usort($projects, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            $this->user->userCv->projects = $projects;
        } else {
            return;
        }
    }

    public function render()
    {
        return view('livewire.cv.show-cv', [
            'user' => $this->user
        ]);
    }
}
