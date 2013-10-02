# README

[![Build Status](https://secure.travis-ci.org/widop/twitter.png)](http://travis-ci.org/widop/twitter)

The Wid'op Twitter library is a modern PHP 5.3+ API allowing you to easily interact with Twitter 1.1.

``` php
use Widop\HttpAdapter\CurlHttpAdapter;
use Widop\Twitter\OAuth;
use Widop\Twitter\Statuses\StatusesUpdateRequest;
use Widop\Twitter\Twitter;

// First, instantiate your OAuth client.
$oauth = new OAuth\OAuth(
    new CurlHttpAdapter(),
    new OAuth\OAuthConsumer('consumer_key', 'consumer_secret'),
    new OAuth\Signature\OAuthHmacSha1Signature()
);

// Second, instantiate your OAuth access token.
$token = new OAuth\OAuthToken('oauth_key', 'oauth_secret');

// Third, instantiate your Twitter client.
$twitter = new Twitter($oauth, $token);

// Then, send a request to the Twitter API!
$request = new StatusesUpdateRequest('Yeah, I\'m currently updating my status!')
$tweet = $twitter->send($request);
```

## Documentation

 1. [Installation](doc/installation.md)
 2. [OAuth](doc/oauth.md)
 3. [Twitter](doc/twitter.md)

## Testing

The library is fully unit tested by [PHPUnit](http://www.phpunit.de/) with a code coverage close to **100%**. To
execute the test suite, check the travis [configuration](.travis.yml).

## Contribute

We love contributors! The library is open source, if you'd like to contribute, feel free to propose a PR!

## License

The Wid'op Twitter library is under the MIT license. For the full copyright and license information, please read the
[LICENSE](LICENSE) file that was distributed with this source code.
