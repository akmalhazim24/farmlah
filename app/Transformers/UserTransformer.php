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
        $avatar = 'https://www.gravatar.com/avatar/'. md5($user->email) . '?s=80&d=mm&r=g';
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'avatar_url' => $avatar,
            'created_at' => $user->created_at,
            'created_at_humanize' => optional($user->created_at)->diffForHumans(),
            'updated_at' => $user->updated_at,
            'updated_at_humanize' => optional($user->updated_at)->diffForHumans()
        ];
    }
}
