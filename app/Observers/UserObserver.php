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
        // For customer accounts in AccueVault, ensure verified status without recalculating legacy fields
        if (!in_array($user->user_type, ['Consultant', 'Student'])) {
            if (empty($user->is_verified)) {
                $user->updateQuietly(['is_verified' => 'Verified']);
            }
            return;
        }

        // Force a calculation of completion percentage for legacy types
        $percentage = $user->profile_completion;

        $newStatus = ($percentage === 100) ? 'Verified' : 'Non-verified';

        if ($user->is_verified !== $newStatus) {
            $user->updateQuietly(['is_verified' => $newStatus]);
        }
    }
}
