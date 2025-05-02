<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobModel;

class JobModelPolicy
{
    public function update(User $user, JobModel $job)
    {
        return $user->id === $job->user_id;
    }
    public function delete(User $user, JobModel $job)
    {
        return $user->id === $job->user_id;
    }
}
