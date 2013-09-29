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
 * Abstract OAuth rsa sha1 signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOAuthRsaSha1Signature implements OAuthSignatureInterface
{
    /**
     * {@inheritdoc}
     */
    public function generate(OAuthRequest $request, $consumerSecret, $tokenSecret = null)
    {
        if (($privateKey = openssl_pkey_get_private($this->getPrivateCertificate())) === false) {
            throw new \RuntimeException('The certificate private key can not be fetched.');
        }

        if (openssl_sign($request->getSignature(), $signature, $privateKey) === false) {
            throw new \RuntimeException('The signature can not be generated.');
        }

        openssl_free_key($privateKey);

        return base64_encode($signature);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'RSA-SHA1';
    }

    /**
     * Gets the private certificate.
     *
     * @return string The private certificate.
     */
    abstract protected function getPrivateCertificate();
}
