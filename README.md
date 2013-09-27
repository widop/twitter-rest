# README

The Wid'op Twitter library is a modern API allowing you to send requests to twitter with PHP 5.3+.

## Sample

``` php
use Widop\HttpAdapter\CurlHttpAdapter;
use Widop\Twitter\OAuth\OAuth;
use Widop\Twitter\OAuth\OAuthConsumer;
use Widop\Twitter\OAuth\OAuthToken;
use Widop\Twitter\OAuth\Signature\OAuthHmacSha1Signature;
use Widop\Twitter\Statuses\StatusesUpdateRequest;
use Widop\Twitter\Twitter;

// First, instantiate an OAuth client with an http adapter, your application credentials and a signature.
$oauth = new OAuth(
    new CurlHttpAdapter(),
    new OAuthConsumer('consumer_key', 'consumer_secret'),
    new OAuthHmacSha1Signature()
);

// Second, instantiate an OAuth access token.
$oautToken = new OAuthToken('oauth_key', 'oauth_secret');

// Third, instantiate a Twitter client with your OAuth client and your access token.
$twitter = new Twitter($oauth, $oauthToken);

// Then, send a request!
$myNewTweet = $twitter->send(new StatusesUpdateRequest('Yeah, I\'m currently updating my status!'));
```

## Documentation

First of all the installation... It is managed by Composer through `widop/twitter`. If you're not familiar with it,
you can read more [here](https://github.com/widop/twitter/tree/master/doc/installation.md).

Basically, the library has been designed in order to process request with an already generated access token. Anyway, if
you want to generate it, the OAuth client is able to archieve this part (see more
[here](https://github.com/widop/twitter/tree/master/doc/oauth.md)).

For now, the supported requests are:

 * Tweets
  * [`/statuses/show/:id`](https://github.com/widop/twitter/tree/master/doc/statuses/show.md): Returns a single Tweet, specified by the id parameter.
  * [`/statuses/update`](https://github.com/widop/twitter/tree/master/doc/statuses/update.md): Updates the authenticating user's current status, also known as tweeting.

If you want to complete the list, your're welcome :)

## Testing

For now, there is no tests. Shame on me... Anyway, testing this library is not so easy... FIXME

## Contribute

We love contributors! The library is open source, if you'd like to contribute, feel free to propose a PR!

## License

The Wid'op Twitter library is under the MIT license. For the full copyright and license information, please read the
[LICENSE](https://github.com/widop/twitter/blob/master/LICENSE) file that was distributed with this source code.
