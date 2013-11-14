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

 * Timeline
  * [`/statuses/home_timeline`](statuses/home_timeline.md): Returns the authenticated user's tweets and retweets.
  * [`/statuses/mentions_timeline`](statuses/mentions_timeline.md): Returns the tweets mentioning the authenticated user.
  * [`/statuses/retweets_of_me`](statuses/retweets_of_me.md): Returns the most recent tweets authored by the authenticating user that have been retweeted by others.
  * [`/statuses/user_timeline`](statuses/user_timeline.md): Returns the tweets of a user's timeline.

 * Tweets
  * [`/statuses/show/:id`](statuses/show.md): Returns a single Tweet, specified by the id parameter.
  * [`/statuses/destroy/:id`](statuses/destroy.md): Destroys the status specified by the required id parameter.
  * [`/statuses/oembed`](statuses/oembed.md): Returns information allowing the creation of an embedded representation of a Tweet on third party sites.
  * [`/statuses/update`](statuses/update.md): Updates the authenticating user's current status, also known as tweeting.
  * [`/statuses/update_with_media`](statuses/update_with_media.md): Updates the authenticating user's current status, also known as tweeting with a media.
  * [`/statuses/retweet/:id`](statuses/retweet.md): Retweets a tweet. Returns the original tweet with retweet details embedded.
  * [`/statuses/retweets/:id`](statuses/retweets.md): Returns a collection of the 100 most recent retweets of the tweet specified by the id parameter.
  * [`/statuses/retweeters/ids`](statuses/retweeters_ids.md): Returns a collection of up to 100 user IDs belonging to users who have retweeted the tweet.

 * Search
  * [`/search/tweets`](search/tweets.md): Returns a collection of relevant Tweets matching a specified query.

Obviously, if you want to complete the list, your're welcome :)
