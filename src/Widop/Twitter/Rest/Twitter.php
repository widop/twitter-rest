<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest;

use Widop\Twitter\OAuth\OAuth;
use Widop\Twitter\OAuth\Token\TokenInterface;

/**
 * Twitter.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class Twitter
{
    /** @var string */
    private $url;

    /** @var \Widop\Twitter\OAuth\OAuth */
    private $oauth;

    /** @var \Widop\Twitter\OAuth\Token\TokenInterface */
    private $token;

    /**
     * Creates a twitter client.
     *
     * @param \Widop\Twitter\OAuth\OAuth                $oauth The OAuth.
     * @param \Widop\Twitter\OAuth\Token\TokenInterface $token The token.
     * @param string                                    $url   The base url.
     */
    public function __construct(OAuth $oauth, TokenInterface $token, $url = 'https://api.twitter.com/1.1')
    {
        $this->setUrl($url);
        $this->setOAuth($oauth);
        $this->setToken($token);
    }

    /**
     * Gets the twitter API url.
     *
     * @return string The twitter API url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the twitter API url.
     *
     * @param string $url The twitter API url.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets OAuth.
     *
     * @return \Widop\Twitter\OAuth\OAuth OAuth.
     */
    public function getOAuth()
    {
        return $this->oauth;
    }

    /**
     * Sets OAuth.
    *
     * @param \Widop\Twitter\OAuth\OAuth $oauth OAuth.
     */
    public function setOAuth(OAuth $oauth)
    {
        $this->oauth = $oauth;
    }

    /**
     * Gets the OAuth token.
     *
     * @return \Widop\Twitter\OAuth\Token\TokenInterface The token.
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Sets the token.
     *
     * @param \Widop\Twitter\Token\TokenInterface $token The token.
     */
    public function setToken(TokenInterface $token)
    {
        $this->token = $token;
    }

    /**
     * Sends a Twitter request.
     *
     * @param \Widop\Twitter\Rest\AbstractRequest $request The Twitter request.
     *
     * @throws \RuntimeException If the response is not valid JSON.
     *
     * @return array The response.
     */
    public function send(AbstractRequest $request)
    {
        $request = $request->createOAuthRequest();
        $request->setBaseUrl($this->getUrl());
        $this->getOAuth()->signRequest($request, $this->getToken());

        $response = $this->getOAuth()->sendRequest($request);
        $result = json_decode($response, true);

        if (($result === null) || (isset($result['errors']))) {
            throw new \RuntimeException(sprintf(
                'The http response is not valid JSON. (%s)',
                str_replace("\n", '', $response)
            ));
        }

        return $result;
    }
}
