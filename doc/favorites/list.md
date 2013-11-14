# Favorites List Request

Returns the 20 most recent Tweets favorited by the authenticating or specified user.

If you do not provide either a user_id or screen_name to this method, it will assume you are requesting on behalf of the authenticating user.
Specify one or the other for best results.

``` php
use Widop\Twitter\Favorites\FavoritesListRequest;

$request = new FavoritesListRequest();

$request->setUserId('123465789');
$userId = $request->getUserId();

$request->setScreenName('widop');
$screenName = $request->getScreenName();

$request->setSinceId('132456789');
$sinceId = $request->getSinceId();

$request->setCount(50);
$count = $request->getCount();

$request->setMaxId('123456789');
$maxId = $request->getMaxId();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$favorites = $twitter->send($request);
```

You can get more informations [here]https://dev.twitter.com/docs/api/1.1/get/favorites/list).
