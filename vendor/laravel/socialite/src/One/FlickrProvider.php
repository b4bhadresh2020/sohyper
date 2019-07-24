<?php

namespace Laravel\Socialite\One;

use InvalidArgumentException;


class FlickrProvider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'FLICKR';
    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user['extra'])->map([
            'id'       => $user['id'],
            'nickname' => $user['nickname'],
            'name'     => $user['name'],
            'email'    => null,
            'avatar'   => null,
        ]);
    }
}