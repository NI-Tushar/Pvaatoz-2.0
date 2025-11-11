<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    // Trigger on user update
    public function updated(User $user)
    {
        $this->updateVerificationStatus($user);
    }

    // Trigger on user creation or save
    public function saved(User $user)
    {
        $this->updateVerificationStatus($user);
    }

    protected function updateVerificationStatus(User $user)
    {
        // Force a fresh calculation of completion percentage
        $percentage = $user->profile_completion; // This will update the database column

        $newStatus = ($percentage === 100) ? 'Non-verified' : 'Non-verified';

        if ($user->is_verified !== $newStatus) {
            $user->updateQuietly(['is_verified' => $newStatus]);
        }
    }
}
