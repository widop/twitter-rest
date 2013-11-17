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
  * [`/statuses/destroy/:id`](statuses/destroy.md): Destroys the status specified by the required id parameter.
  * [`/statuses/oembed`](statuses/oembed.md): Returns information allowing the creation of an embedded representation of a Tweet on third party sites.
  * [`/statuses/retweet/:id`](statuses/retweet.md): Retweets a tweet. Returns the original tweet with retweet details embedded.
  * [`/statuses/retweets/:id`](statuses/retweets.md): Returns a collection of the 100 most recent retweets of the tweet specified by the id parameter.
  * [`/statuses/retweeters/ids`](statuses/retweeters_ids.md): Returns a collection of up to 100 user IDs belonging to users who have retweeted the tweet.
  * [`/statuses/show/:id`](statuses/show.md): Returns a single Tweet, specified by the id parameter.
  * [`/statuses/update`](statuses/update.md): Updates the authenticating user's current status, also known as tweeting.
  * [`/statuses/update_with_media`](statuses/update_with_media.md): Updates the authenticating user's current status, also known as tweeting with a media.

 * Search
  * [`/search/tweets`](search/tweets.md): Returns a collection of relevant Tweets matching a specified query.

 * Direct Messages
  * [`/direct_messages`](direct_messages/direct_messages.md): Returns the 20 most recent direct messages sent to the authenticating user.
  * [`/direct_messages/destroy`](direct_messages/destroy.md): Destroys the direct message specified in the required ID parameter.
  * [`/direct_messages/new`](direct_messages/new.md): Sends a new direct message to the specified user from the authenticating user.
  * [`/direct_messages/sent`](direct_messages/sent.md): Returns the 20 most recent direct messages sent to the authenticating user.
  * [`/direct_messages/show`](direct_messages/show.md): Returns a single direct message, specified by an id parameter.

 * Friends & followers
  * [`/favorites/ids`](favorids/ids.md): Returns a cursored collection of user IDs for every user following the specified user.
  * [`/favorites/list`](favorids/list.md): Returns a cursored collection of user objects for users following the specified user.
  * [`/friends/ids`](friends/ids.md): Returns a cursored collection of user IDs for every user the specified user is following.
  * [`/friends/list`](friends/list.md): Returns a cursored collection of user objects for every user the specified user is following.
  * [`/friendships/create`](friendships/create.md): Allows the authenticating users to follow the user specified in the ID parameter.
  * [`/friendships/destroy`](friendships/destroy.md): Allows the authenticating user to unfollow the user specified in the ID parameter.
  * [`/friendships/incoming`](friendships/incoming.md): Returns a collection of numeric IDs for every user who has a pending request to follow the authenticating user.
  * [`/friendships/lookup`](friendships/lookup.md): Returns the relationships of the authenticating user to the comma-separated list of up to 100 screen_names or user_ids provided.
  * [`/friendships/no_retweets_ids`](friendships/no_retweets_ids.md): Returns a collection of user_ids that the currently authenticated user does not want to receive retweets from.
  * [`/friendships/outgoing`](friendships/outgoing.md): Returns a collection of numeric IDs for every protected user for whom the authenticating user has a pending follow request.
  * [`/friendships/show`](friendships/show.md): Returns detailed information about the relationship between two arbitrary users.
  * [`/friendships/update`](friendships/update.md): Allows one to enable or disable retweets and device notifications from the specified user.

 * Favorites
  * [`/favorites/create`](favorites/create.md): Favorites the status specified in the ID parameter as the authenticating user.
  * [`/favorites/destroy`](favorites/destroy.md): Un-favorites the status specified in the ID parameter as the authenticating user.
  * [`/favorites/list`](favorites/list.md): Returns the 20 most recent Tweets favorited by the authenticating or specified user.

 * Saved Searches
  * [`saved_searches/list`](saved-searches/.md): Returns the authenticated user's saved search queries.
  * [`saved_searches/show/:id`](saved-searches/show.md): Retrieve the information for the saved search represented by the given id.
  * [`saved_searches/create`](saved-searches/create.md): Create a new saved search for the authenticated user.
  * [`saved_searches/destroy/:id`](saved-searches/destroy.md): Destroys a saved search for the authenticating user.

 * Trends
  * [`/trends/available`](trends/available.md): Returns the locations that Twitter has trending topic information for.
  * [`/trends/closest`](trends/closest.md): Returns the locations that Twitter has trending topic information for, closest to a specified location.
  * [`/trends/place`](trends/place.md): Returns the top 10 trending topics for a specific WOEID, if trending information is available for it.

 * Spam Reporting
  * [`/users/spam_report`](users/spam_report.md): Report the specified user as a spam account to Twitter.

Obviously, if you want to complete the list, you're welcome :)
