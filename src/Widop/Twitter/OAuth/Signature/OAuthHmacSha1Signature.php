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
 * OAuth Hmac Sha1 signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthHmacSha1Signature implements OAuthSignatureInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(OAuthRequest $request, $consumerSecret, $tokenSecret = null)
    {
        return base64_encode(hash_hmac(
            'sha1',
            $request->getSignature(),
            rawurlencode($consumerSecret).'&'.rawurlencode($tokenSecret),
            true
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'HMAC-SHA1';
    }
}
