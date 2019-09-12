<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'created_at' => $user->created_at,
            'created_at_humanize' => optional($user->created_at)->diffForHumans(),
            'updated_at' => $user->updated_at,
            'updated_at_humanize' => optional($user->updated_at)->diffForHumans()
        ];
    }
}
