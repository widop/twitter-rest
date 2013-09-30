# OAuth Signature

The OAuth protocol defines some algorithms which can be used in order to sign/trust your requests. The library allows
you to use all of them :)

## Hmac Sha1

``` php
use Widop\Twitter\OAuth\Signature\OAuthHmacSha1Signature;

$signature = new OAuthHmacSha1Signature();
```

## Rsa Sha1

For the rsa sha1 signature, the library provides an abstract class allowing you to define your own way to get your
private certificate.

``` php
use Widop\Twitter\OAuth\Signature\AbstractOAuthRsaSha1Signature;

/**
 * OAuth rsa sha1 signature.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthRsaSha1Signature extends AbstractOAuthRsaSha1Signature
{
    /**
     * {@inheritdoc}
     */
    public function getPrivateCertificate()
    {
        return file_get_contents('/path/to/private/certificate');
    }
}
```

## Plaintext

``` php
use Widop\Twitter\OAuth\Signature\OAuthPlaintextSignature;

$signature = new OAuthPlaintextSignature();
```
