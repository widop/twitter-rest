# Twitter Client

The library has been designed to send request to the Twitter API. In order to do that, you will need a Twitter client.
This one needs itself an OAuth client to sign request & an access token. If you want to learn more about this access
token, you can read this [documentation](doc/oauth.md).

So, first, create your Twitter client:

``` php
use Widop\HttpAdapter\CurlHttpAdapter;
use Widop\Twitter\OAuth;
use Widop\Twitter\Rest\Statuses\StatusesUpdateRequest;
use Widop\Twitter\Rest\Twitter;

$oauth = new OAuth\OAuth(
    new CurlHttpAdapter(),
    new OAuth\OAuthConsumer('consumer_key', 'consumer_secret'),
    new OAuth\Signature\OAuthHmacSha1Signature()
);

$token = new OAuth\Token\OAuthToken('oauth_key', 'oauth_secret');

$twitter = new Twitter($oauth, $token);
```

Note that is also possible to pass a "bearer" token (eg: application access token):

``` php
use Widop\Twitter\OAuth\Token\BearerToken;

$bearerToken = new BearerToken('foo');

$twitter = new Twitter($oauth, $token);

// or

$twitter->setToken($bearerToken);
```

Now, we got a twitter client, you can get/set the OAuth client, get/set the access token or send a request to the
Twitter API.

``` php
use Widop\Twitter\Rest\Statuses\StatusesDestroyRequest;

$oauth = $twitter->getOAuth();
$twitter->setOAuth($oauth);

$token = $twitter->getToken();
$twitter->setToken($token);
```

Here, we will destroy the tweet "123":

``` php
use Widop\Twitter\Rest\Statuses\StatusesDestroyRequest;

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

 * Account
  * [`GET /account/settings`](account/get_settings.md): Returns settings (including current trend, geo and sleep time information) for the authenticating user.
  * [`POST /account/settings`](account/post_settings.md): Updates the authenticating user's settings.
  * [`/account/remove_profile_banner`](account/remove_profile_banner.md): Removes the uploaded profile banner for the authenticating user
  * [`/account/update_delivery_device`](account/update_delivery_device.md): Sets which device Twitter delivers updates to for the authenticating user.
  * [`/account/update_profile`](account/update_profile.md): Sets values that users are able to set under the "Account" tab of their settings page.
  * [`/account/update_profile_background_image`](account/update_profile_background_image.md): Updates the authenticating user's profile background image.
  * [`/account/update_profile_banner`](account/update_profile_banner.md): Uploads a profile banner on behalf of the authenticating user.
  * [`/account/update_profile_colors`](account/update_profile_colors.md): Allows one to enable or disable retweets and device notifications from the specified user.
  * [`/account/update_profile_image`](account/update_profile_image.md): Updates the authenticating user's profile image.
  * [`/account/verify_credentials`](account/verify_credentials.md): Use this method to test if supplied user credentials are valid.

 * Users
  * [`/users/contributees`](users/contributees.md): Returns a collection of users that the specified user can "contribute" to.
  * [`/users/contributors`](users/contributors.md): Returns a collection of users who can contribute to the specified account.
  * [`/users/lookup`](users/lookup.md): Returns fully-hydrated user objects for up to 100 users per request, as specified by comma-separated values passed to the user_id and/or screen_name parameters.
  * [`/users/profile_banner`](users/profile_banner.md): Returns a map of the available size variations of the specified user's profile banner.
  * [`/users/search`](users/search.md): Provides a simple, relevance-based search interface to public user accounts on Twitter.
  * [`/users/show`](users/show.md): Returns a variety of information about the user specified by the required user_id or screen_name parameter.

 * Blocks
  * [`/blocks/create`](blocks/create.md): Blocks the specified user from following the authenticating user.
  * [`/blocks/destroy`](blocks/destroy.md): Un-blocks the user specified in the ID parameter for the authenticating user.
  * [`/blocks/ids`](blocks/ids.md): Returns an array of numeric user ids the authenticating user is blocking.
  * [`/blocks/list`](blocks/list.md): Returns a collection of user objects that the authenticating user is blocking.

 * Suggested Users
  * [`/users/suggestions`](suggestions/suggestions.md): Access to Twitter's suggested user list.
  * [`/users/suggestions/:slug`](suggestions/suggestions_slug.md): Access the users in a given category of the Twitter suggested user list.
  * [`/users/suggestions/:slug/members`](suggestions/suggestions_slug_members.md): Access the users in a given category of the Twitter suggested user list and return their most recent status if they are not a protected user.

 * Favorites
  * [`/favorites/create`](favorites/create.md): Favorites the status specified in the ID parameter as the authenticating user.
  * [`/favorites/destroy`](favorites/destroy.md): Un-favorites the status specified in the ID parameter as the authenticating user.
  * [`/favorites/list`](favorites/list.md): Returns the 20 most recent Tweets favorited by the authenticating or specified user.

 * Lists
  * [`/lists/create`](lists/create.md): Creates a new list for the authenticated user.
  * [`/lists/destroy`](lists/destroy.md): Deletes the specified list.
  * [`/lists/list`](lists/list.md): Returns all lists the authenticating or specified user subscribes to, including their own.
  * [`/lists/members`](lists/members.md): Returns the members of the specified list.
  * [`/lists/members/create`](lists/members_create.md): Add a member to a list.
  * [`/lists/members/create_all`](lists/members_create_all.md): Adds multiple members to a list, by specifying a comma-separated list of member ids or screen names.
  * [`/lists/members/destroy`](lists/members_destroy.md): Removes the specified member from the list.
  * [`/lists/members/destroy_all`](lists/members_destroy_all.md): Removes multiple members from a list, by specifying a comma-separated list of member ids or screen names.
  * [`/lists/members/show`](lists/members_show.md): Check if the specified user is a member of the specified list.
  * [`/lists/memberships`](lists/memberships.md): Returns the lists the specified user has been added to.
  * [`/lists/ownerships`](lists/ownerships.md): Returns the lists owned by the specified Twitter user.
  * [`/lists/show`](lists/show.md): Returns the specified list.
  * [`/lists/statuses`](lists/statuses.md): Returns a timeline of tweets authored by members of the specified list.
  * [`/lists/subscribers`](lists/subscribers.md): Returns the subscribers of the specified list.
  * [`/lists/subscribers/create`](lists/subscribers_create.md): Subscribes the authenticated user to the specified list.
  * [`/lists/subscribers/destroy`](lists/subscribers_destroy.md): Unsubscribes the authenticated user from the specified list.
  * [`/lists/subscribers/show`](lists/subscribers_show.md): Check if the specified user is a subscriber of the specified list.
  * [`/lists/subscriptions`](lists/subscriptions.md): Obtain a collection of the lists the specified user is subscribed to.
  * [`/lists/update`](lists/update.md): Updates the specified list.

 * Saved Searches
  * [`saved_searches/list`](saved-searches/.md): Returns the authenticated user's saved search queries.
  * [`saved_searches/show/:id`](saved-searches/show.md): Retrieve the information for the saved search represented by the given id.
  * [`saved_searches/create`](saved-searches/create.md): Create a new saved search for the authenticated user.
  * [`saved_searches/destroy/:id`](saved-searches/destroy.md): Destroys a saved search for the authenticating user.

 * Places & Geo
  * [`geo/id/:place_id`](geo/id_place_id.md): Returns all the information about a known place.
  * [`geo/reverse_geocode`](geo/reverse_geocode.md): Given a latitude and a longitude, searches for up to 20 places that can be used as a place_id when updating a status.
  * [`geo/search`](geo/search.md): Search for places that can be attached to a statuses/update.
  * [`geo/similar_places`](geo/similar_places.md): Locates places near the given coordinates which are similar in name.

 * Trends
  * [`/trends/available`](trends/available.md): Returns the locations that Twitter has trending topic information for.
  * [`/trends/closest`](trends/closest.md): Returns the locations that Twitter has trending topic information for, closest to a specified location.
  * [`/trends/place`](trends/place.md): Returns the top 10 trending topics for a specific WOEID, if trending information is available for it.

 * Spam Reporting
  * [`/users/spam_report`](users/spam_report.md): Report the specified user as a spam account to Twitter.

 * Application & Help
  * [`application/rate_limit_status`](application/rate_limit_status.md):
  * [`help/configuration`](help/configuration.md):
  * [`help/languages`](help/languages.md):
  * [`help/privacy`](help/privacy.md):
  * [`help/tos`](help/tos.md):

Obviously, if you want to complete the list, you're welcome :)
