<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\OAuth;

use Widop\HttpAdapter\HttpAdapterInterface;
use Widop\Twitter\OAuth\Signature\OAuthSignatureInterface;

/**
 * OAuth.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuth
{
    /** @var \Widop\HttpAdapter\HttpAdapterInterface */
    private $httpAdapter;

    /** @var string */
    private $url;

    /** @var \Widop\Twitter\OAuth\OAuthConsumer */
    private $consumer;

    /** @var \Widop\Twitter\OAuth\Signature\OAuthSignatureInterface */
    private $signature;

    /** @var string */
    private $version;

    /**
     * Creates an OAuth client.
     *
     * @param \Widop\HttpAdapter\HttpAdapterInterface                $httpAdapter The http adapter.
     * @param \Widop\Twitter\OAuth\OAuthConsumer                     $consumer    The OAuth consumer.
     * @param \Widop\Twitter\OAuth\Signature\OAuthSignatureInterface $signature   The OAuth signature.
     * @param string                                                 $url         The OAuth base url.
     * @param string                                                 $version     The OAuth version.
     */
    public function __construct(
        HttpAdapterInterface $httpAdapter,
        OAuthConsumer $consumer,
        OAuthSignatureInterface $signature,
        $url = 'https://api.twitter.com/oauth',
        $version = '1.0'
    ) {
        $this->setHttpAdapter($httpAdapter);
        $this->setUrl($url);
        $this->setConsumer($consumer);
        $this->setSignature($signature);
        $this->setVersion($version);
    }

    /**
     * Gets the http adapter.
     *
     * @return \Widop\HttpAdapter\HttpAdapterInterface The http adapter.
     */
    public function getHttpAdapter()
    {
        return $this->httpAdapter;
    }

    /**
     * Sets the http adapter.
     *
     * @param \Widop\HttpAdapter\HttpAdapterInterface $httpAdapter The http adapter.
     */
    public function setHttpAdapter(HttpAdapterInterface $httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
    }

    /**
     * Gets the OAuth base url.
     *
     * @return string The OAuth base url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the OAuth base url.
     *
     * @param string $url The OAuth base url.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the OAuth consumer.
     *
     * @return \Widop\Twitter\OAuth\OAuthConsumer The OAuth consumer.
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * Sets the OAuth consumer.
     *
     * @param \Widop\Twitter\OAuth\OAuthConsumer $consumer
     */
    public function setConsumer(OAuthConsumer $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * Gets the OAuth signature.
     *
     * @return \Widop\Twitter\OAuth\Signature\OAuthSignatureInterface The OAuth signature.
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Sets the OAuth signature.
     *
     * @param \Widop\Twitter\OAuth\Signature\OAuthSignatureInterface $signature The OAuth signature.
     */
    public function setSignature(OAuthSignatureInterface $signature)
    {
        $this->signature = $signature;
    }

    /**
     * Gets the OAuth version.
     *
     * @return string The OAuth version.
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets the OAuth version.
     *
     * @param string $version The OAuth version.
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Gets a request token.
     *
     * @param string $callback The OAuth callback.
     *
     * @return \Widop\Twitter\OAuth\OAuthToken The request token.
     */
    public function getRequestToken($callback = 'oob')
    {
        $request = $this->createRequest('/request_token', 'POST');
        $request->setOAuthParameter('oauth_callback', $callback);
        $this->signRequest($request);

        $response = $this->getHttpAdapter()->postContent($request->getUrl(), $request->getHeaders());

        return $this->createToken($response);
    }

    /**
     * Gets the authorize url.
     *
     * @param \Widop\Twitter\OAuth\OAuthToken $requestToken The request token.
     *
     * @return string The authorize url.
     */
    public function getAuthorizeUrl(OAuthToken $requestToken)
    {
        return sprintf('%s/authorize?oauth_token=%s', $this->getUrl(), $requestToken->getKey());
    }

    /**
     * Gets an access token.
     *
     * @param \Widop\Twitter\OAuth\OAuthToken $requestToken The request token.
     * @param string                          $verifier     The OAuth verifier.
     *
     * @return \Widop\Twitter\OAuth\OAuthToken The access token.
     */
    public function getAccessToken(OAuthToken $requestToken, $verifier)
    {
        $request = $this->createRequest('/access_token', 'POST');
        $request->setOAuthParameter('oauth_verifier', $verifier);
        $this->signRequest($request, $requestToken);

        $response = $this->getHttpAdapter()->postContent($request->getUrl(), $request->getHeaders());

        return $this->createToken($response);
    }

    /**
     * Sign a request.
     *
     * @param \Widop\Twitter\OAuth\OAuthRequest    $request The request.
     * @param \Widop\Twitter\OAuth\OAuthToken|null $token   The access token.
     */
    public function signRequest(OAuthRequest $request, OAuthToken $token = null)
    {
        $oauthParameters = array(
            'oauth_version'          => $this->getVersion(),
            'oauth_consumer_key'     => $this->getConsumer()->getKey(),
            'oauth_signature_method' => $this->getSignature()->getName(),
        );

        if ($token !== null) {
            $oauthParameters['oauth_token'] = $token->getKey();
        }

        $request->setOAuthParameters($oauthParameters);
        $request->setOAuthParameter('oauth_signature', $this->getSignature()->generate(
            $request,
            $this->getConsumer()->getSecret(),
            ($token !== null) ? $token->getSecret() : null
        ));
    }

    /**
     * Creates an OAuth request.
     *
     * @param string $path   The OAuth path.
     * @param string $method The http method.
     *
     * @return \Widop\Twitter\OAuth\OAuthRequest The OAuth request.
     */
    private function createRequest($path, $method)
    {
        $request = new OAuthRequest();
        $request->setBaseUrl($this->getUrl());
        $request->setPath($path);
        $request->setMethod($method);

        return $request;
    }

    /**
     * Creates a token according to an http response.
     *
     * @param string $response The http response.
     *
     * @throws \RuntimeException If the token can not be created.
     *
     * @return \Widop\Twitter\OAuth\OAuthToken The OAuth token.
     */
    private function createToken($response)
    {
        parse_str($response, $datas);

        if (!isset($datas['oauth_token']) || !isset($datas['oauth_token_secret'])) {
            throw new \RuntimeException(sprintf(
                'An error occured when creating the OAuth token. (%s)',
                str_replace("\n", '', $response)
            ));
        }

        return new OAuthToken($datas['oauth_token'], $datas['oauth_token_secret']);
    }
}
