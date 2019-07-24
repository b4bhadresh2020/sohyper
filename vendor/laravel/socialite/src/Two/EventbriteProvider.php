<?php

namespace Laravel\Socialite\Two;

use Illuminate\Support\Arr;

class EventbriteProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'EVENTBRITE';
    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://www.eventbrite.com/oauth/authorize', $state
        );
    }
    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://www.eventbrite.com/oauth/token';
    }
    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get(
            'https://www.eventbriteapi.com/v3/users/me', [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    public function userImage($token,$imageId)
    {
        $response = $this->getHttpClient()->get(
            'https://www.eventbriteapi.com/v3/media/'.$imageId, [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'    => $user['id'], 'nickname' => null, 'name' => $user['name'],
            'email' => $user['emails'][0]['email'], 'avatar' => $user['image_id'],
        ]);
    }
    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
