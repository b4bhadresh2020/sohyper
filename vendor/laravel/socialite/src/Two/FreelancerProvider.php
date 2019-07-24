<?php

namespace Laravel\Socialite\Two;

use Illuminate\Support\Arr;
use GuzzleHttp\Psr7;

class FreelancerProvider extends AbstractProvider implements ProviderInterface
{
   /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'FREELANCER';
    /**
     * {@inheritdoc}
     */
    protected $scopeSeparator = ' ';
    /**
     * {@inheritdoc}
     */
    protected $scopes = ['basic'];
    /**
     * {@inheritdoc}
     */
    
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(
            'https://accounts.freelancer.com/oauth/authorise', $state
        );
    }
    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://accounts.freelancer.com/oauth/token';
    }
   

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {

        $response = $this->getHttpClient()->get('https://www.freelancer.com/api/users/0.1/self/', [            
            'headers' => [ 
                'freelancer-oauth-v1'=> 'cvrZYUqZuCSAKXaMxUI2Hyrqrwm85q'
            ],
        ]);

        return json_decode($response->getBody(), true);
    }


    /**
     * {@inheritdoc}
     */
    public function getAccessTokenResponse($code)
    {     

        $params = $this->getTokenFields($code);
        $params['grant_type']  = "authorization_code";

        $response = new Psr7\Request("POST",$this->getTokenUrl(), [            
            'headers' => [
                'content-type' => 'x-www-form-urlencoded',
                'freelancer-oauth-v1' => 'cvrZYUqZuCSAKXaMxUI2Hyrqrwm85q'                
            ],
            'form_params' => $params,
        ]);

        $responseHeader = $response->getHeaders();
        $token = $responseHeader['headers']['freelancer-oauth-v1'];
        return array('access_token' => $token);                      
        
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        
        return (new User())->setRaw($user)->map([
            'id'     => $user['result']['id'], 'nickname' => $user['result']['display_name'],
            'name'   => ($user['result']['public_name']!="")?$user['result']['public_name']:$user['result']['display_name'], 'email' => $user['result']['email'],
            'avatar' => $user['result']['avatar']            
        ]);
    }    
    
}
