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
 * OAuth consumer.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthConsumer
{
    /** @var string */
    private $key;

    /** @var string */
    private $secret;

    /**
     * Creates an OAuth consumer.
     *
     * @param string $key    The consumer key.
     * @param string $secret The consumer secret.
     */
    public function __construct($key, $secret)
    {
        $this->setKey($key);
        $this->setSecret($secret);
    }

    /**
     * Gets the consumer key.
     *
     * @return string The consumer key.
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets the consumer key.
     *
     * @param string $key The consumer key.
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Gets the consumer secret.
     *
     * @return string The consumer secret.
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Sets the consumer secret.
     *
     * @param string $secret The consumer secret.
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }
}
