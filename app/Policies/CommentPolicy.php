<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
   

        public function delete(User $user, Comment $comment): bool
        {
            return $user->isAdmin==True;
        }
    
}
