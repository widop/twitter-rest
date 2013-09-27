<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\OAuth\Signature;

use Widop\Twitter\OAuth\OAuthRequest;

/**
 * OAuth signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface OAuthSignatureInterface
{
    /**
     * Generates the signature.
     *
     * @param \Widop\Twitter\OAuth\OAuthRequest $request        The OAuth request.
     * @param string                            $consumerSecret The OAuth consumer secret.
     * @param string|null                       $tokenSecret    The OAuth token secret.
     *
     * @return string The signature.
     */
    public function generate(OAuthRequest $request, $consumerSecret, $tokenSecret = null);

    /**
     * Gets the signature name.
     *
     * @return string The signature name.
     */
    public function getName();
}
