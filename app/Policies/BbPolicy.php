<?php

namespace App\Policies;

use App\Models\Bb;
use App\Models\User;

class BbPolicy
{
    public function update(User $user, Bb $bb)
    {
        return $bb->user->id === $user->id;
    }

    public function destroy(User $user, Bb $bb)
    {
        return $this->update($user, $bb);
    }
}
