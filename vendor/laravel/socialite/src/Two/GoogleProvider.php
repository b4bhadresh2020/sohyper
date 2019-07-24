<?php

namespace Laravel\Socialite\Two;

use Illuminate\Support\Arr;

class GoogleProvider extends AbstractProvider implements ProviderInterface
{
    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [
        'openid',
        'profile',
        'email',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://accounts.google.com/o/oauth2/auth', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://accounts.google.com/o/oauth2/token';
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        try{
            $response = $this->getHttpClient()->get('https://www.googleapis.com/plus/v1/people/me?', [
                'query' => [
                    'prettyPrint' => 'false',
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);  

            return json_decode($response->getBody(), true);

        }catch (\Exception $exception) {

            $responseBody = (string) $exception->getResponse()->getBody()->getContents();
            $response = json_decode($responseBody);
            $message = $response->error->message;

            return array("type"=>"error","message"=>$message);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        if(isset($user['kind'])){
            return (new User)->setRaw($user)->map([
                'id' => $user['id'], 'nickname' => Arr::get($user, 'nickname'), 'name' => $user['displayName'],
                'email' => $user['emails'][0]['value'], 'avatar' => Arr::get($user, 'image')['url'],
                'avatar_original' => preg_replace('/\?sz=([0-9]+)/', '', Arr::get($user, 'image')['url']),
            ]);
        }else{
            return (new User)->setRaw($user);
        }
    }
}
