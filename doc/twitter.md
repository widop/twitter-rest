# Twitter Client

The library has been designed to send request to the Twitter API. In order to do that, you will need a Twitter client.
This one needs itself an OAuth client to sign request & an access token. If you want to learn more about this access
token, you can read this [documentation](doc/oauth.md).

So, first, create your Twitter client:

``` php
use Widop\HttpAdapter\CurlHttpAdapter;
use Widop\Twitter\OAuth;
use Widop\Twitter\Statuses\StatusesUpdateRequest;
use Widop\Twitter\Twitter;

$oauth = new OAuth\OAuth(
    new CurlHttpAdapter(),
    new OAuth\OAuthConsumer('consumer_key', 'consumer_secret'),
    new OAuth\Signature\OAuthHmacSha1Signature()
);

$token = new OAuth\OAuthToken('oauth_key', 'oauth_secret');

$twitter = new Twitter($oauth, $token);
```

Now, we got a twitter client, you can get/set the OAuth client, get/set the access token or send a request to the
Twitter API.

``` php
use Widop\Twitter\Statuses\StatusesDestroyRequest;

$oauth = $twitter->getOAuth();
$twitter->setOAuth($oauth);

$token = $twitter->getOAuthToken();
$twitter->setOAuthToken($token);
```

Here, we will destroy the tweet "123":

``` php
use Widop\Twitter\Statuses\StatusesDestroyRequest;

$request = new StatusesDestroyRequest('123');
$twitter->send($request);
```

For now, the build-in requests are:

 * Tweets
  * [`/statuses/show/:id`](doc/statuses/show.md): Returns a single Tweet, specified by the id parameter.
  * [`/statuses/destroy/:id`](doc/statuses/destroy.md): Destroys the status specified by the required id parameter.
  * [`/statuses/update`](doc/statuses/update.md): Updates the authenticating user's current status, also known as tweeting.
  * [`/statuses/update_with_media`](doc/statuses/update_with_media.md): Updates the authenticating user's current status, also known as tweeting with a media.

Obviously, if you want to complete the list, your're welcome :)
