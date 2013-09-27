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

/**
 * OAuth token.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthToken
{
    /** @var string */
    private $key;

    /** @var string */
    private $secret;

    /**
     * Creates an OAuth token.
     *
     * @param string $key    The token key.
     * @param string $secret The token secret.
     */
    public function __construct($key, $secret)
    {
        $this->setKey($key);
        $this->setSecret($secret);
    }

    /**
     * Gets the token key.
     *
     * @return string The token key.
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the token key.
     *
     * @param string $key The token key.
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Gets the token secret.
     *
     * @return string The token secret.
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Sets the token secret.
     *
     * @param string $secret The token secret.
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }
}
