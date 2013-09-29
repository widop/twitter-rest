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
 * OAuth plaintext signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthPlaintextSignature implements OAuthSignatureInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(OAuthRequest $request, $consumerSecret, $tokenSecret = null)
    {
        return rawurlencode($consumerSecret).'&'.rawurlencode($tokenSecret);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PLAINTEXT';
    }
}
