<?php

namespace App\Policies;

use App\Models\Meme;
use App\Models\User;

class MemePolicy
{
    /**
     * Semua user boleh melihat feed (viewAny).
     */
    public function viewAny(User $user): bool
    {
        return true; 
    }

    /**
     * User boleh melihat meme jika meme itu publik, 
     * atau jika user itu pemiliknya sendiri (jika eksklusif).
     */
    public function view(User $user, Meme $meme): bool
    {
        if (!$meme->is_exclusive) {
            return true;
        }
        return $user->id === $meme->user_id;
    }

    /**
     * Hanya user yang sudah login boleh create.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Hanya pemilik yang boleh update.
     */
    public function update(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id;
    }

    /**
     * Hanya pemilik yang boleh delete.
     */
    public function delete(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id;
    }

    /**
     * Opsional: Restore & ForceDelete untuk SoftDeletes
     */
    public function restore(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id;
    }

    public function forceDelete(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id;
    }
}