<?php

namespace Laravel\Socialite;

use InvalidArgumentException;
use Illuminate\Support\Manager;
use Laravel\Socialite\One\TwitterProvider;
use Laravel\Socialite\One\BitbucketProvider;
use Laravel\Socialite\One\FlickrProvider;
use League\OAuth1\Client\Server\Twitter as TwitterServer;
use League\OAuth1\Client\Server\Bitbucket as BitbucketServer;
use League\OAuth1\Client\Server\Flickr as FlickrServer;

class SocialiteManager extends Manager implements Contracts\Factory
{
    /**
     * Get a driver instance.
     *
     * @param  string  $driver
     * @return mixed
     */
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGithubDriver()
    {
        $config = $this->app['config']['services.github'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\GithubProvider', $config
        );
    }

    protected function createMeetupDriver()
    {
        $config = $this->app['config']['services.meetup'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\MeetupProvider', $config
        );
    }

    protected function createEventbriteDriver()
    {
        $config = $this->app['config']['services.eventbrite'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\EventbriteProvider', $config
        );
    }

    protected function createFoursquareDriver()
    {
        $config = $this->app['config']['services.foursquare'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\FoursquareProvider', $config
        );
    }

    protected function createInstagramDriver()
    {
        $config = $this->app['config']['services.instagram'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\InstagramProvider', $config
        );
    }

    protected function createStravaDriver()
    {
        $config = $this->app['config']['services.strava'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\StravaProvider', $config
        );
    }

    protected function createWeiboDriver()
    {
        $config = $this->app['config']['services.weibo'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\WeiboProvider', $config
        );
    }

    protected function createFreelancerDriver()
    {
        $config = $this->app['config']['services.freelancer'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\FreelancerProvider', $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createFacebookDriver()
    {
        $config = $this->app['config']['services.facebook'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\FacebookProvider', $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createGoogleDriver()
    {
        $config = $this->app['config']['services.google'];

        return $this->buildProvider(
            'Laravel\Socialite\Two\GoogleProvider', $config
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    protected function createLinkedinDriver()
    {
        $config = $this->app['config']['services.linkedin'];

        return $this->buildProvider(
          'Laravel\Socialite\Two\LinkedInProvider', $config
        );
    }

    /**
     * Build an OAuth 2 provider instance.
     *
     * @param  string  $provider
     * @param  array  $config
     * @return \Laravel\Socialite\Two\AbstractProvider
     */
    public function buildProvider($provider, $config)
    {
        return new $provider(
            $this->app['request'], $config['client_id'],
            $config['client_secret'], $config['redirect']
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\One\AbstractProvider
     */
    protected function createTwitterDriver()
    {
        $config = $this->app['config']['services.twitter'];

        return new TwitterProvider(
            $this->app['request'], new TwitterServer($this->formatConfig($config))
        );
    }

    /**
     * Create an instance of the specified driver.
     *
     * @return \Laravel\Socialite\One\AbstractProvider
     */
    protected function createBitbucketDriver()
    {
        $config = $this->app['config']['services.bitbucket'];

        return new BitbucketProvider(
            $this->app['request'], new BitbucketServer($this->formatConfig($config))
        );
    }

    protected function createFlickrDriver()
    {
        $config = $this->app['config']['services.flickr'];

        return new FlickrProvider(
            $this->app['request'], new FlickrServer($this->formatConfig($config))
        );
    }

    /**
     * Format the server configuration.
     *
     * @param  array  $config
     * @return array
     */
    public function formatConfig(array $config)
    {
        return array_merge([
            'identifier' => $config['client_id'],
            'secret' => $config['client_secret'],
            'callback_uri' => $config['redirect'],
        ], $config);
    }

    /**
     * Get the default driver name.
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        throw new InvalidArgumentException('No Socialite driver was specified.');
    }
}
