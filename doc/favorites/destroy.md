# Favorites Destroy Request

Un-favorites the status specified in the ID parameter as the authenticating user. Returns the un-favorited status in
the requested format when successful.

The tweeter process invoked by this method is asynchronous so the returned status may not indicate the resultant
favorited status of the tweet.

``` php
use Widop\Twitter\Favorites\FavoritesDestroyRequest;

$request = new FavoritesDestroyRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$tweetUnfavorited = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/favorites/destroy).
